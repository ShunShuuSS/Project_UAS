<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index(){
        // check if user logged
        if(Session::get('hotel_login_status')){
            return view('pages.login');{{  }}
        }
        // user not logged in
        return Redirect::to('login');
    }

}
