<?php

namespace App\Http\Controllers;

use App\BusAdmin;
use App\Bus;
use App\TopUpRequest;
use App\TripHistory;
use Illuminate\Http\Request;
use App\Repo\BusRepoImpl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class MaskapaiController extends Controller {
    // Session KEY
    const SESS_USER = "user";

    private $bus_repo;

    public function __construct() {
        $this->bus_repo = new BusRepoImpl();
    }

    public function home() {
        return view('maskapai/home', ['title' => $_ENV['APP_NAME']]);
    }

    public function login(Request $req) {
        $email = $req->input('email');
        $password = $req->input('password');

        if($email == "" || $password == "") {
            // set error
            return response()->json([
                'error' => 'Email atau password tidak boleh kosong'
            ], 403);
        }

        $bus_admin = BusAdmin::where('email', $email)->first();

        if($bus_admin == null) {
            // set error
            return response()->json([
                'error' => 'Akun tidak terdaftar'
            ], 403);
        }

        if(!app('hash')->check($password, $bus_admin->password)) {
            return response()->json([
                'error' => 'Email atau katasandi salah, mohon dicoba lagi'
            ], 403);
        }

        // save user id in session  
        $req->session()->put("user", ['id' => $bus_admin->id]);

        return redirect()->route('dashboard');
    }

    public function dashboard(Request $req) {
        // get session
        $id = $req->session()->get("user")['id'];
        $busses = $this->bus_repo->get_busses($id);
        
        if(count($busses) <= 0) {
            // set empty
            return view('maskapai/empty_dashboard');
        }

        return view('maskapai/dashboard', ['busses' => $busses]);    
    }

    public function add_bus(Request $req) {
        $bus_number = $req->input('bus_number');
        $price = $req->input('price');

        $bus_admin_id = $req->session()->get("user")['id'];

        // validator
        // ...

        $bus_data = [
            'bus_number' => $bus_number, 
            'price' => $price, 
            'bus_admin_id' => $bus_admin_id
        ];
        
        try {
            $bus = Bus::create($bus_data);
            
            // create qr code
            $qr = new ImageRenderer(
                new RendererStyle(400),
                new ImagickImageBackEnd()
            );

            $writer = new Writer($qr);

            // save to Storage
            Storage::put("qr/{$bus->id}.png", $writer->writeString("{$bus->id}"));

            // return redirect()->route('dashboard');
            return redirect()->route('edit_bus', ['id' => $bus->id]);

        } catch (Exception $e) {
            dd($e);
            // log the exception
            return response()->json(['error' => 'Sistem bermasalah'], 400);
        }
    }

    public function delete_bus(Request $req) {
        $id = $req->input('id');
        try {
            $bus = Bus::where('id', $id)->delete();
        } catch (\Throwable $th) {
            // loggin exception
        }

        return redirect()->route('dashboard');
    }

    public function view_routes(Request $req) {
        $bus_id = $req->input('bus_id');
        $routes = DB::table('route')
            ->select('id','queue','location_name')
            ->where('bus_id', $bus_id)
            ->get();
        
        return response()->json($routes, 200);
    }

    public function edit_bus(Request $req) {
        $id = $req->input('id');
        
        $bus = null;
        
        try {
            $bus = Bus::where('id', $id)->firstOrFail();
            $routes = DB::table('route')
                ->select('location_name', 'queue')
                ->where('bus_id', $id)
                ->get();
        } catch(Exception $e) {
            // logging the exception
            dd($e);
        }

        return view('maskapai/edit', ['bus' => $bus, 'routes' => $routes, 'session' => session("user")]);
    }

    public function save_edit(Request $req) {
        $bus_number = $req['bus_number'];
        $price = $req['price'];
        $bus_id = $req['bus_id'];
        $routes = $req['routes'];

        // validate the input

        // mapping the routes input
        try {
            // recreate the route
            DB::beginTransaction();
            DB::delete("DELETE FROM route WHERE bus_id = $bus_id ");
            foreach ($routes as $key => $route) {
                    DB::table('route')->insert([
                        'location_name' => $route['location_name'],
                        'queue' => $route['queue'],
                        'latitude' => 0,
                        'longitude' => 0,
                        'bus_id' => $bus_id, 
                    ]);
            }

            $bus = Bus::where('id', $bus_id)
                ->update([
                    'bus_number' => $bus_number,
                    'price' => $price
                ]);

            DB::commit();
        } catch(\Exception $e) {
            return response()->json(500);
            // logging error
            dd($e);
        }

        return response()->json(200);
        // return redirect()->route('dashboard');
    }

    public function download_qr(Request $req) {
        $bus_id = $req->input('bus_id');
        $file_path = "qr/{$bus_id}.png";

        try {
            // $file = Storage::get($file_path);
            return Storage::download($file_path);
        } catch (Exception $e) {
            var_dump($e);
        }
    }
}