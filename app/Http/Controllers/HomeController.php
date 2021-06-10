<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function aboutus(){
        return view('pages.aboutus');
    }

    public function index(){
        $locations = Location::all();
        // $locationName = $location['location'];
        $hotel = Hotel::all();
        return view('pages.user.home')
        ->with([
            'hotels' => $hotel,
            'locations' => $locations
        ]);
    }

    // public function filter($test){
    //     if()
    // }

    public function filterByLocation($id)
    {
        $loc = Location::all();

        return view('pages.user.home')
            ->with('locs', $loc);
    }

    public function filterByStar(){
        $hotel = Hotel::where('rating', '>', 3)->get();
        return view('pages.user.homefilter')
        ->with([
            'hotels' => $hotel,
            // 'location' => $locationName
        ]);
    }

    public function detail_view($id){
        $hotel = Hotel::where('id_hotel',$id)
            ->join('location', 'location.id_location', '=', 'hotel.id_location')
            ->first();
        $facilities = DB::table('hotel_facilities')
            ->join('hotel', 'hotel.id_hotel', '=', 'hotel_facilities.id_hotel')
            ->join('facilities', 'facilities.id_facility', '=', 'hotel_facilities.id_facility')
            ->select('hotel.*', 'facilities.name as facility_name')
            ->where('hotel_facilities.id_hotel',$id)
            ->get();
        return view('pages.user.hoteldetail')
            ->with([
                'hotel' => $hotel,
                'facilities' => $facilities,
            ]);
    }

    public function profile_view(){
        $id_user = Session::get('hotel_id_user');
        $user = User::where('id_user', $id_user)->first();
        return view('pages.user.profile')
            ->with([
                'user' => $user,
            ]);
    }

    public function profile_edit(Request $request){
        $request->validate([
            'name' => 'required',
            // 'email' => 'required',
            'password' => ['confirmed'],
            // 'birthdate' => 'required',
            'phone_number' => 'required'
        ]);

        $id_user = Session::get('hotel_id_user');
        $user = User::where('id_user', $id_user)->first();
        $name = $request->name;
        $password = hash('sha256', $request->password);
        // $birthdate = $request->birthdate;
        $phone_number = $request->phone_number;
        $link_photo = $request->file('link_photo');

        // Upload Imgur
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

        $column = '
            name = ?,
            phone_number = ?'
        ;

        $data = [
            $name,
            $phone_number
        ];

        if($password){
            $column .= ', password = ?';
            array_push($data, $password);
        }
        
        if($link_photo){
            $column .= ', link_photo = ?';
            array_push($data, $url);
        }

        $response = DB::update("update user
            set $column
            where id_user = ?",
            [...$data, $id_user]
        );

        if(!$response){
            echo 'error';
            echo $response;
            return Redirect::to('/profile');
        }

        return Redirect::to('/profile');
    }
    
}
