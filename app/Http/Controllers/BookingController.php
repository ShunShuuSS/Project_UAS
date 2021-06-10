<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function booking_view($id)
    {
        $hotel = Hotel::where('id_hotel',$id)->first();
        $id_user = Session::get('hotel_id_user');
        $user = User::where('id_user', $id_user)->first();
        return view('pages.user.booking')
            ->with([
                'hotel' => $hotel,
                'user' => $user,
            ]);
    }

    public function booking(Request $request)
    {
        $request->validate([
            Booking::all()
        ]);

        $bookingId = $this->IdGeneratorBooking();
        $hotelId = $request->id_hotel;
        $userId = Session::get('hotel_id_user');
        $name = $request->name;
        $phoneNumber = $request->phonenumber;
        $email = $request->email;
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;
        $totalRoom = $request->total_room;
        $getHotelPrice = $request->hotel_price;
        $totalPrice = $totalRoom * $getHotelPrice;

        if(!$checkIn){
            Session::flash('booking_failed_message', 'Check-in cannot be null');
            return view('pages.user.booking');
        }

        if(!$checkOut){
            Session::flash('booking_failed_message', 'Check-out cannot be null');
            return view('pages.user.booking');
        }

        $response = DB::insert(
            'insert into booking (id_booking, id_hotel, id_user, name, phonenumber, email, check_in, check_out, total_room, price)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [$bookingId, $hotelId, $userId, $name, $phoneNumber, $email ,$checkIn, $checkOut, $totalRoom, $totalPrice]
        );

        if(!$response){
            Session::flash('booking_failed', 'Booking Failed');
            Redirect::to('booking');
        }

        return Redirect::to('home');
    }

    public function booking_list()
    {
        $id_user = Session::get('hotel_id_user');
        $user = User::where('id_user', $id_user)->first();
        $bookingList = Booking::where('id_user', $id_user)->get();
        $hotel = Hotel::join('booking', 'booking.id_hotel', '=', 'hotel.id_hotel')
            ->select('hotel.image_link', 'hotel.name', 'hotel.id_hotel')
            ->get();

        return view('pages.user.bookinglist')
            ->with([
                'booking_list' => $bookingList,
                'hotel' => $hotel
            ]);
    }

    public function booking_detail($id)
    {
        $booking = Booking::where('id_booking', $id)->first();
        $hotel = Hotel::join('booking', 'booking.id_hotel', '=', 'hotel.id_hotel')
            ->select('hotel.image_link', 'hotel.name')
            ->get();
        return view('pages.user.bookingdetail')
            ->with([
                'booking' => $booking,
                'hotel' => $hotel
            ]);
    }

    private function IdGeneratorBooking()
    {
        $getLastData = Booking::orderBy('id_booking', 'desc')->first();

        if(!$getLastData){
            return 'B00001';
        }

        $getId = $getLastData['id_booking'];

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
