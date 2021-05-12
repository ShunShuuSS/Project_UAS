<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelFacilities;
use App\Models\HotelRoom;
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
    // HOTEL
    public function hotel_list()
    {
        return view('pages.admin.adminhome')
        ->with('hotels', Hotel::all());
    }

    public function hotel_edit_view($id)
    {
        $response = Hotel::where('id_hotel', $id)->first();
        return view('pages.admin.adminedithotel')
        ->with('edithotel', $response);
    }

    public function hotel_add_view()
    {
        $facilities = DB::table('facilities')->get();
        $locations = DB::table('location')->get();
        return view('pages.admin.adminadd')
            ->with([
                'facilities' => $facilities,
                'locations' => $locations
                ]);
    }

    public function hotel_add(Request $request){
        $request->validate([
            'name' => 'required',
            'id_location' => 'required',
            'room_quantity' => 'required',
            'price' => 'required'
        ]);

        // $count = 0;
        // $arrayFacilities[$count] = [];
        // for($i = 0; $i < $request->count_facility; $i++){
        //     $arrayFacilities[$count] = $request->input("facility$i");
        //     $count++;
        // }
        // return ;

        // $count = 0;
        // $arrayFacilities[$count] = [];
        // for($i = 0; $i < $request->count_facility; $i++){
            
        //     $arrayFacilities[$count] = $request->count_facility;
            
        //     $count++;
            
        // }
        // echo $arrayFacilities[0];
        // return $count;

        $hotelId = $this->IdGeneratorHotel();
        $name = $request->name;
        $locationId = $request->id_location;
        $roomQuantity = $request->room_quantity;
        $price = $request->price;

        $count = $request->count_facility;
        $arrayFacility[$count] = [];
        for($i = 0; $i < $count; $i++){
            $arrayFacility[$i] = $request->input("facility$i");
        }

        $response = DB::insert(
            'insert into hotel (id_hotel, name, id_location, room_quantity, price)
            values (?, ?, ?, ?, ?)',
            [$hotelId, $name, $locationId, $roomQuantity, $price]
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

         $response = DB::table('hotel')
            ->where('id_hotel', $id)
            ->update([
                'name' => $name,
                'id_location' => $locationId,
                'room_quantity' => $roomQuantity,
                'price' => $price
            ]
        );

        if(!$response){
            Session::flash('update_data_hotel_failed', 'Update data hotel error');
        }

        Session::put('update_data_hotel_success', 'Update data hotel success');
        return Redirect::to('admin/hotels/home');
    }

    public function hotel_delete($id){
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
        $hotelFacilities = HotelFacilities::where('id_hotel', $id)->get();
        return view('pages.admin.adminfacility')
        ->with([
            'facilities' => $hotelFacilities,
            'id_hotel' => $id
        ]);
    }

    // add facility from add hotel
    public function facility_add_view($id){
        $facilities = DB::table('facilities')->get();
        $hotelFacilities = HotelFacilities::where('id_hotel', $id)->get();
        return view('pages.admin.adminfacilityadd')
        ->with([
            'editfacilities' => $hotelFacilities,
            'facilities' => $facilities
        ]);
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
        return view('pages.admin.adminuser')
        ->with('users', User::all());
    }

    public function user_add_view(){
        $user = DB::table('user')->get();
        $role = DB::table('role')->get();
        return view('pages.admin.adminuseradd')
            ->with([
                'users' => $user,
                'roles' => $role
            ]);
    }

    public function user_add(Request $request){
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
        $user = User::where('id_user', $id)->first();
        $role = DB::table('role')->get();
        return view('pages.admin.adminuseredit')
            ->with([
                'useredit' => $user,
                'roleedit' => $role
            ]);
    }

    public function user_edit(Request $request, $id){
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
        
        if($link_photo){
            $column .= ', link_photo = ?';
            array_push($data, $link_photo);
        }

        if($roleId){
            $column .= ', id_role = ?';
            array_push($data, $roleId);
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
        DB::table('user')->where('id_user', $id)->delete();
        return Redirect::to('admin/users');
    }

    // FUNCTION NEEDED

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
