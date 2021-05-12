@extends('pages/app')

@section('title', 'Hotel')
@yield('script')
@section('content')
<p class="text-center" style="font-size: 36px">Hotel Room List</p>
<script>
    $(document).ready(function () {
        $('#hotelroom').DataTable();
    });

</script>

{{-- <div class="text-center" style="width: 50%">
    <a class="btn btn-success" href="{{ url('admin/home') }}" title="">
<i class="fas fa-plus-circle"></i></a>
</div> --}}
<div class="container-fluid">
    {{-- <div class="container">
        <button class="">
            Submit
        </button>
    </div> --}}

    <table id="hotelroom" class="table table-striped table-bordered" style="width:100%">
        
        <thead>
            <tr>
                <th>ID Room</th>
                <th>ID Hotel</th>
                <th>Room Type</th>
                <th>Price Per Day</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td>{{ $room['id_room'] }}</td>
                <td>{{ $room['id_hotel'] }}</td>
                <td>{{ $room['id_room_type'] }}</td>
                <td>{{ $room['price_per_day'] }}</td>
                <td>
                    <a href="{{ url('admin/hotels/room/edit_view/' . $room['id_room']) }}">Edit Room</a>
                </td>
            </tr>
            @endforeach
        <tfoot>
            <tr>
                <th>ID Room</th>
                <th>ID Hotel</th>
                <th>Room Type</th>
                <th>Price Per Day</th>
                <th>Details</th>
            </tr>
        </tfoot>
    </table>
</div>

{{-- <div>
    <button :class="{ danger: isDeleting }">
        Submit
    </button>
</div> --}}
@endsection
