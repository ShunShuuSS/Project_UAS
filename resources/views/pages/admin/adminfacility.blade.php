@extends('pages/app')

@section('title', 'Hotel')
@yield('script')
@section('content')
<p class="text-center" style="font-size: 36px">Hotel Facilities List</p>
<script>
    $(document).ready(function () {
        $('#hotelfacilities').DataTable();
    });

</script>

<div class="container-fluid">
    <table id="hotelfacilities" class="table table-striped table-bordered" style="width:100%">
        
        <thead>
            <tr>
                <th>ID Hotel</th>
                <th>ID Facility</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facilities as $facility)
            <tr>
                <td>{{ $facility['id_hotel'] }}</td>
                <td>{{ $facility['id_facility'] }}</td>
                <td>
                    <a href="{{ url('admin/hotels/facility/delete/'.$facility['id_hotel'].'/'.$facility['id_facility']) }}">Delete</a>
                </td>
            </tr>
            @endforeach
        <tfoot>
            <tr>
                <th>ID Hotel</th>
                <th>ID Facility</th>
                <th>Details</th>
            </tr>
        </tfoot>
    </table>
</div>

<div>
    <a href="{{ url('admin/hotels/facility/add_view/'.$id_hotel) }}" class="btn btn-warning">Add Facility</a>
</div>
@endsection
