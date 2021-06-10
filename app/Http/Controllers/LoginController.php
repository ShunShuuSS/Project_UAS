<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    private function cek_login(){
        if(Session::has('hotel_id_user')){
            $response = User::where([
                'id_user' => Session::get('hotel_id_user')
            ])->first();
            if($response['id_role'] == 'R00001'){
                Redirect::to('admin/users');
            }else if($response['id_role'] == 'R00002'){
                // Redirect to user page
            }
        }
    }
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

        $idRole = $response['id_role'];
        if($idRole == "R00001"){
            return Redirect::to('admin/users');
        }else if($idRole == "R00002"){
            return Redirect::to('home');
        }
        
        // return Redirect::to('/');
    }
    
    public function logout(Request $request){
        Session::forget('hotel_login_status');
        Session::forget('hotel_id_user');
        return Redirect::to('login');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'birthdate' => 'required',
            'phone_number' => 'required',
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = hash('sha256', $request->password);
        $birthdate = $request->birthdate;
        $phone_number = $request->phone_number;

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

        if($request->file('link_photo')){
            // Upload Imgur
            $link_photo = $request->file('link_photo');
            $file_path = $link_photo->getPathName();
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://api.imgur.com/3/image', [
                'headers' => [
                        'authorization' => 'Client-ID ' . '00ac96cfc377c5a',
                        'content-type' => 'application/x-www-form-urlencoded',
                    ],
                'form_params' => [
                        'image' => base64_encode(file_get_contents($request->file('link_photo')->path($file_path)))
                    ],
                ]);
            $url = data_get(response()->json(json_decode(($response->getBody()->getContents())))->getData(), 'data.link');

            if($link_photo){
                $column .= ', link_photo';
                $values .= ', ?';
                array_push($data, $url);
            }
        }
        // $link_photo = $request->file('link_photo');

        if($this->checkEmail($email)){
            Session::flash('register_failed_message', 'Email already used');
            return view('pages.register');
        }else{
            $response = DB::insert(
                "insert into user ($column)
                values ($values)",
                $data
            );

            if(!$response){
                Session::flash('register_failed_message', 'Register Failed');
                Redirect::to('register');
            }else{
                Session::put('hotel_login_status', true);
                Session::put('hotel_id_user', $this->getLastIdUser());
        
                return Redirect::to('home');
            }
        }
        
        
    }

    private function checkEmail($email){
        $check = User::where('email', $email)->first();

        if($check){
            return true;
        }else{
            false;
        }
    }

    private function getLastIdUser(){
        $user = User::orderByRaw('id_user DESC')->first();
        return $user['id_user'];
    }
}
