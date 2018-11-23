<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repo\AdminRepoImpl;

class AdminController extends Controller
{
    const SESS_USER = "admin";

    private $admin_repo;

    public function __construct(){
        $this->admin_repo = new AdminRepoImpl();
    }

    public function dashboard(Request $req) {
        // get session
        $id = $req->session()->get("admin")['id'];
        $top_up_request = $this->admin_repo->getTopUpRequest();
        
        if(count($top_up_request) <= 0) {
            // set empty
            return view('admin/empty_dashboard');
        }

        return view('admin/dashboard', ['top_ups' => $top_up_request]);    
    }
}