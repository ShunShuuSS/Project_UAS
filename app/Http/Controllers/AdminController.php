<?php

namespace App\Http\Controllers;

use App\Models\Facilitiy;
use App\Models\Hotel;
use App\Models\HotelFacilities;
use App\Models\HotelRoom;
use App\Models\Location;
use App\Models\RoomType;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use function PHPSTORM_META\type;

class AdminController extends Controller
{
    private function cek_login(){
        if(!Session::has('hotel_id_user')){
            Redirect::to('login');
        }
    }
    // HOTEL
    public function hotel_list()
    {
        $this->cek_login();
        return view('pages.admin.adminhome')
        ->with('hotels', Hotel::all());
    }

    public function hotel_edit_view($id)
    {
        $this->cek_login();
        $edithotel = Hotel::where('id_hotel', $id)->first();
        $location = Location::join('hotel', 'hotel.id_location', '=', 'location.id_location')
            ->where('hotel.id_hotel', $id)
            ->select('location.id_location')
            ->first();
        $locations = Location::all();
        return view('pages.admin.adminedithotel')
            ->with([
                'edithotel' => $edithotel,
                'locations' => $locations,
                'hotel_location' => $location
            ]);
    }

    public function hotel_add_view()
    {
        $this->cek_login();
        $facilities = DB::table('facilities')->get();
        $locations = DB::table('location')->get();
        return view('pages.admin.adminadd')
            ->with([
                'facilities' => $facilities,
                'locations' => $locations
                ]);
    }

    public function hotel_add(Request $request){
        $this->cek_login();
        $request->validate([
            'name' => 'required',
            'id_location' => 'required',
            'room_quantity' => 'required',
            'price' => 'required'
        ]);

        $hotelId = $this->IdGeneratorHotel();
        $name = $request->name;
        $locationId = $request->id_location;
        $roomQuantity = $request->room_quantity;
        $price = $request->price;
        $description = $request->description;
        $rating = $request->rating;
        $hotelPic = $request->file('image_link');
        
        // Upload Imgur
        $file_path = $hotelPic->getPathName();
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.imgur.com/3/image', [
            'headers' => [
                    'authorization' => 'Client-ID ' . '00ac96cfc377c5a',
                    'content-type' => 'application/x-www-form-urlencoded',
                ],
            'form_params' => [
                    'image' => base64_encode(file_get_contents($request->file('image_link')->path($file_path)))
                ],
            ]);
        $url = data_get(response()->json(json_decode(($response->getBody()->getContents())))->getData(), 'data.link');

        $count = $request->count_facility;
        $arrayFacility[$count] = [];
        for($i = 0; $i < $count; $i++){
            $arrayFacility[$i] = $request->input("facility$i");
        }

        $column = '
            id_hotel,
            name,
            id_location,
            room_quantity,
            price'
        ;

        $values = '?, ?, ?, ?, ?';

        $data = [
            $hotelId,
            $name,
            $locationId,
            $roomQuantity,
            $price
        ];

        if($rating){
            $column .= ', rating';
            $values .= ', ?';
            array_push($data, $rating);
        }

        if($hotelPic){
            $column .= ', image_link';
            $values .= ', ?';
            array_push($data, $url);
        }
        
        if($description){
            $column .= ', description';
            $values .= ', ?';
            array_push($data, $description);
        }

        $response = DB::insert(
            "insert into hotel ($column)
            values ($values)",
            $data
        );

        DB::beginTransaction();
        try{
            for($i = 0; $i < $count; $i++){
                if($arrayFacility[$i]){
                    DB::insert('insert into hotel_facilities (id_hotel, id_facility) values (?, ?)', [$hotelId, $request->input("facility$i")]);
                }
            }
        }catch(Exception $e){
            // sekip
        }
        DB::commit();

        if(!$response){
            return 'gagal insert';
        }

        return Redirect::to('admin/hotels/home');
    }

    public function hotel_edit(Request $request, $id)
    {
        $this->cek_login();
        $request->validate([
            'name' => 'required',
            'id_location' => 'required',
            'room_quantity' => 'required',
            'price' => 'required'
        ]);

        $name = $request->name;
        $locationId = $request->id_location;
        $roomQuantity = $request->room_quantity;
        $price = $request->price;
        $description = $request->description;
        $rating = $request->rating;
        $hotelPic = $request->file('image_link');
        
        // Upload Imgur
        $file_path = $hotelPic->getPathName();
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.imgur.com/3/image', [
            'headers' => [
                    'authorization' => 'Client-ID ' . '00ac96cfc377c5a',
                    'content-type' => 'application/x-www-form-urlencoded',
                ],
            'form_params' => [
                    'image' => base64_encode(file_get_contents($request->file('image_link')->path($file_path)))
                ],
            ]);
        $url = data_get(response()->json(json_decode(($response->getBody()->getContents())))->getData(), 'data.link');

        $count = $request->count_facility;
        $arrayFacility[$count] = [];
        for($i = 0; $i < $count; $i++){
            $arrayFacility[$i] = $request->input("facility$i");
        }

        $column = '
            name = ?,
            id_location = ?,
            room_quantity = ?,
            price = ?'
        ;

        $data = [
            $name,
            $locationId,
            $roomQuantity,
            $price
        ];

        if($rating){
            $column .= ', rating = ?';
            array_push($data, $rating);
        }

        // if($hotelPic){
        //     $column .= ', image_link = ?';
        //     array_push($data, $url);
        // }
        
        if($description){
            $column .= ', description = ?';
            array_push($data, $description);
        }

        $response = DB::update(
            "update hotel
            set $column
            where id_hotel = ?", [...$data, $id]
        );

        if(!$response){
            Session::flash('update_data_hotel_failed', 'Update data hotel error');
        }

        Session::put('update_data_hotel_success', 'Update data hotel success');
        return Redirect::to('admin/hotels/home');
    }

    public function hotel_delete($id){
        $this->cek_login();
        $response = DB::table('hotel_facilities')->where('id_hotel', $id)->delete();

        $response = DB::table('hotel')->where('id_hotel', $id)->delete();

        if(!$response){
            return 'gagal delete hotel';
        }

        return Redirect::to('admin/hotels/home');
    }

    // FACILITY

    public function facility_view($id)
    {
        $this->cek_login();
        $hotelFacilities = HotelFacilities::where('id_hotel', $id)->get();
        return view('pages.admin.adminfacility')
        ->with([
            'facilities' => $hotelFacilities,
            'id_hotel' => $id
        ]);
    }

    // add facility from add hotel
    public function facility_add_view($id){
        $this->cek_login();
        $facilities = DB::table('facilities')->get();
        $hotelFacilities = HotelFacilities::where('id_hotel', $id)->get();
        return view('pages.admin.adminfacilityadd')
        ->with([
            'editfacilities' => $hotelFacilities,
            'facilities' => $facilities
        ]);
    }

    public function facility_delete($id_hotel, $id_facility){
        $this->cek_login();
        DB::table('hotel_facilities')->where([
            'id_hotel' => $id_hotel,
            'id_facility' => $id_facility
        ])->delete();
        return Redirect::to("admin/hotels/facility/$id_hotel");
    }

    // public function DeleteFacility($id_hotel, $id_facility){
    //     $getHotelId = $this->getHotelId($id_hotel);
    //     DB::table('hotel_facilities')
    //         ->where([
    //             'id_hotel' => $id_hotel,
    //             'id_facilities' => $id_facility
    //         ])->delete();
    //     return Redirect::to("admin/hotels/facility/$getHotelId");
    // }

    // USER

    public function user_list(){
        $this->cek_login();
        return view('pages.admin.adminuser')
        ->with('users', User::all());
    }

    public function user_add_view(){
        $this->cek_login();
        $user = DB::table('user')->get();
        $role = DB::table('role')->get();
        return view('pages.admin.adminuseradd')
            ->with([
                'users' => $user,
                'roles' => $role
            ]);
    }

    public function user_add(Request $request){
        $this->cek_login();
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
            'birthdate' => 'required',
            'phone_number' => 'required'
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = hash('sha256', $request->password);
        $birthdate = $request->birthdate;
        $phone_number = $request->phone_number;
        $link_photo = $request->link_photo;
        $roleId = $request->id_role;

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
        
        if($link_photo){
            $column .= ', link_photo';
            $values .= ', ?';
            array_push($data, $link_photo);
        }

        if($roleId){
            $column .= ', id_role';
            $values .= ', ?';
            array_push($data, $roleId);
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
        return Redirect::to('admin/users');
    }

    public function user_edit_view($id){
        $this->cek_login();
        $user = User::where('id_user', $id)->first();
        $role = DB::table('role')->get();
        return view('pages.admin.adminuseredit')
            ->with([
                'useredit' => $user,
                'roleedit' => $role
            ]);
    }

    public function user_edit(Request $request, $id){
        $this->cek_login();
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'birthdate' => 'required',
            'phone_number' => 'required'
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = hash('sha256', $request->password);
        $birthdate = $request->birthdate;
        $phone_number = $request->phone_number;
        $link_photo = $request->link_photo;
        $roleId = $request->id_role;

        $column = '
            name = ?,
            email = ?,
            password = ?,
            birthdate = ?,
            phone_number = ?'
        ;

        $data = [
            $name,
            $email,
            $password,
            $birthdate,
            $phone_number
        ];

        if($password){
            $column .= ', password = ?';
            array_push($data, $password);
        }


        if($roleId){
            $column .= ', id_role = ?';
            array_push($data, $roleId);
        }

        if($request->file('link_photo')){
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
                $column .= ', link_photo = ?';
                array_push($data, $url);
            }
        }
        
        $response = DB::update("update user
            set $column
            where id_user = ?",
            [...$data, $id]
        );

        if(!$response){
            Session::flash('update_user_failed_message', 'Update User Failed');
            Redirect::to("admin/users/edit/$id");
        }
        // Session::put('hotel_login_status', true);
        // Session::put('hotel_id_user', $id_user);
        return Redirect::to('admin/users');
    }

    public function user_delete($id){
        $this->cek_login();
        DB::table('user')->where('id_user', $id)->delete();
        return Redirect::to('admin/users');
    }

    // FUNCTION NEEDED

    private function getHotelId(){

    }

    private function IdGeneratorHotel(){
        $getLastData = Hotel::orderBy('id_hotel', 'desc')->first();

        if(!$getLastData){
            return 'H00001';
        }

        $getId = $getLastData['id_hotel'];

        $charLen = 1;
        $charStr = substr($getId, 0, $charLen);
        $idStr = substr($getId, $charLen);// "00000001" get length = 8
        $idInt = intval($idStr);// 1 get length = 1
        $idInt++;
        $zeroCount = strlen(strval($idStr)) - strlen(strval($idInt)); // 7

        $zeroString = '';
        while($zeroCount != 0){
            $zeroString .= "0";
            $zeroCount--;
        }

        return $charStr.$zeroString.$idInt;
    }
}
