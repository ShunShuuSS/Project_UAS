@extends('pages/app')

@section('title', 'Hotel')
@yield('script')

@section('content')
<p class="text-center" style="font-size: 36px">Hotel List</p>
<script>
    $(document).ready(function () {
        $('#hoteltable').DataTable();
    });
</script>
<a type="button" href="{{ url('admin/hotels/add_view') }}" class="btn btn-warning">Create Hotel</a>

<div class="container-fluid">
    <table id="hoteltable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID Hotel</th>
                <th>Hotel Name</th>
                <th>Location</th>
                <th>Rating</th>
                <th>Room Quantity</th>
                <th>Price</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hotels as $hotel)
            <tr>
                <td>{{ $hotel['id_hotel'] }}</td>
                <td>{{ $hotel['name'] }}</td>
                <td>{{ $hotel['id_location'] }}</td>
                <td>{{ $hotel['rating'] }}</td>
                <td>{{ $hotel['room_quantity'] }}</td>
                <td>{{ $hotel['price'] }}</td>
                <td>
                    {{-- <a href="{{ url('admin/hotels/room/'.$hotel['id_hotel']) }}">Room</a> --}}
                    <a type="button" href="{{ url('admin/hotels/facility/'.$hotel['id_hotel']) }}" class="btn btn-warning">Facilities</a>
                    <a type="button" href="{{ url('admin/hotels/'.$hotel['id_hotel']) }}" class="btn btn-warning">Edit Hotel</a>
                    <a type="button" href="{{ url('admin/hotels/delete/'.$hotel['id_hotel']) }}" class="btn btn-warning">Delete Hotel</a>
                </td>
            </tr>
            @endforeach
        <tfoot>
            <tr>
                <th>ID Hotel</th>
                <th>Hotel Name</th>
                <th>Location</th>
                <th>Rating</th>
                <th>Room Quantity</th>
                <th>Price</th>
                <th>Details</th>
            </tr>
        </tfoot>
    </table>
    
</div>
@endsection
