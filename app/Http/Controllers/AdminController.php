<?php

namespace App\Http\Controllers;

use App\Repo\Transaction;
use App\TopUpRequest;
use App\WithdrawRequest;
use Illuminate\Http\Request;
use App\Repo\AdminRepoImpl;

class AdminController extends Controller
{
    const SESS_USER = "admin";

    private $admin_repo;

    public function __construct(){
        $this->admin_repo = new AdminRepoImpl();
    }

    public function home(){
        return session("admin") != null 
            ? redirect()->route('top_up')
            : view('maskapai/home', ['title' => $_ENV['APP_NAME']]);
    }

    public function logout(Request $req) {
        $req->session()->forget('admin');
        return redirect()->route('home');
    }

    public function topUp(Request $req) {
        // get session
        $id = $req->session()->get("admin")['id'];
        $top_up_requests = $this->admin_repo->getTopUpRequest();
        
        if(count($top_up_requests) <= 0) {
            // set empty
            return view('admin/empty_view', ['message' => "Top Up Request"]);
        }

        return view('admin/topup', ['top_up_requests' => $top_up_requests]);    
    }

    public function acceptTopUp(Request $req){
        try{
            TopUpRequest::where('id', $req['id'])->update(['accepted_status' => Transaction::$ACCEPTED]);
        }catch(Exception $e){
            report($e);
            return redirect()->route('error');
        }

        return redirect()->route('top_up');
    }
    
    public function declineTopUp(Request $req){
        try{
            TopUpRequest::where('id', $req['id'])->update(['accepted_status' => Transaction::$DECLINED]);
        }catch(Exception $e){
            report($e);
            return redirect()->route('error');
        }

        return redirect()->route('top_up');
    }
    
    public function withdraw() {
        $withdraw_requests = $this->admin_repo->getWithdrawRequest();
        
        if(count($withdraw_requests) <= 0) {
            // set empty
            return view('admin/empty_view', ['message' => "Withdraw Request"]);
        }

        return view('admin/withdraw', ['withdraw_requests' => $withdraw_requests]);    
    }

    public function acceptWithdraw(Request $req){
        try{
            WithdrawRequest::where('id', $req['id'])->update(['accepted_status' => Transaction::$ACCEPTED]);
        } catch(Exception $e){
            report($e);
            return redirect()->route('error');
        }

        return redirect()->route('admin_withdraw');
    }

    public function declineWithdraw(Request $req){
        try{
            WithdrawRequest::where('id', $req['id'])->update(['accepted_status' => Transaction::$DECLINED]);
        }catch(Exception $e){
            report($e);
            return redirect()->route('error');
        }

        return redirect()->route('admin_withdraw');
    }

    public function manifesto(){
        $manifesto_datas = $this->admin_repo->getManifestoData();

        if ($manifesto_datas <= 0) {
            return view('admin/empty_view', ['message' => "data Manifesto"]);
        }

        return view('admin/manifesto', ['manifesto_datas' => $manifesto_datas]);
    }

    public function error(){
        return view('admin/error');
    }
}