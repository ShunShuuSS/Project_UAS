<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function view_login(){
        return view('pages/login');
    }

    public function view_register(){
        return view('pages/register');
    }

    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        
        $email = $request->email;
        $password = hash('sha256', $request->password);
        
        $response = User::where([
            'email' => $email,
            'password' => $password
        ])->first();
        
        if(!$response){
            Session::flash('login_failed_message', 'Login Failed');
            return Redirect::to('login');
        }

        // Set settion buat user
        Session::put('hotel_login_status', true);
        Session::put('hotel_id_user', $response->id_user);
        return Redirect::to('/');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'birthdate' => 'required',
            'phone_number' => 'required'
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = hash('sha256', $request->password);
        $birthdate = $request->birthdate;
        $phone_number = $request->phone_number;
        $link_photo = $request->link_photo;

        $column = '
            name, 
            email, 
            password, 
            birthdate, 
            phone_number'
        ;
        
        $values = '?, ?, ?, ?, ?';

        $data = [
            $name,
            $email,
            $password,
            $birthdate,
            $phone_number
        ];
        
        if($link_photo){
            $column .= ', link_photo';
            $values .= ', ?';
            array_push($data, $link_photo);
        }

        $response = DB::insert(
            "insert into user ($column)
            values ($values)",
            $data
        );
        if(!$response){
            Session::flash('register_failed_message', 'Register Failed');
            Redirect::to('register');
        }
        Session::put('hotel_login_status', true);
        // Session::put('hotel_id_user', $id_user);
        return Redirect::to('login');
    }

    private function getId($id){
        $findUser = User::where('id_user', $id);
        $getId = $findUser['id_user'];
        return $getId;
    }
}
