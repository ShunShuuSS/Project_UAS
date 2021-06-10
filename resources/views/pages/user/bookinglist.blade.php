@extends('pages/app-user')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <h1 class="mb-4 text-gray-800 text-center">Booking List</h1>

</div>
{{-- {{ $hotel }} --}}
@for ($i = 0; $i < count($booking_list); $i++)
<div class="card m-5">
    <div class="row">
        <div class="col-md-3">
            @for ($j = 0; $j < count($hotel); $j++)
                @if ($booking_list[$i]->id_hotel == $hotel[$j]->id_hotel)
                    <img class="col-12" src="{{ $hotel[$j]->image_link }}">
                    @break
                @endif
            @endfor
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <h5 class="card-title">Nomor Pemesanan : {{ $booking_list[$i]->id_booking }}</h5>
                @for ($j = 0; $j < count($hotel); $j++)
                    @if ($booking_list[$i]->id_hotel == $hotel[$j]->id_hotel)
                        <p class="card-text">Hotel : {{ $hotel[$j]->name }}</p>
                        @break
                    @endif
                @endfor
                <p class="card-text">Check-in : {{ $booking_list[$i]->check_in }} | Check-out : {{ $booking_list[$i]->check_out }}</p>
                <p class="card-text">Harga : Rp. {{ $booking_list[$i]->price }}</p>
            </div>
        </div>
        <div class="col-md-2 text-center">
            <div class="card-body">
                <a class="btn btn-dark" type="submit" href="{{ url('booking_detail/'.$booking_list[$i]->id_booking) }}">Detail</a>
            </div>
        </div>
    </div>
</div>
@endfor

@endsection
