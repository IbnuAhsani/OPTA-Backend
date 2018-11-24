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

    public function topUp(Request $req) {
        // get session
        $id = $req->session()->get("admin")['id'];
        $top_up_requests = $this->admin_repo->getTopUpRequest();
        
        if(count($top_up_requests) <= 0) {
            // set empty
            return view('admin/empty_dashboard');
        }

        return view('admin/topup', ['top_up_requests' => $top_up_requests]);    
    }
    
    public function withdraw(Request $req) {
        // get session
        $id = $req->session()->get("admin")['id'];
        $withdraw_requests = $this->admin_repo->getWithdrawRequest();
        
        if(count($withdraw_requests) <= 0) {
            // set empty
            return view('admin/empty_dashboard');
        }

        return view('admin/withdraw', ['withdraw_requests' => $withdraw_requests]);    
    }
}