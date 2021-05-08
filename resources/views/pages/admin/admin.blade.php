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
<div class="text-center" style="width: 50%">
    <a class="btn btn-success" href="{{ url('admin/home') }}" title="">
        <i class="fas fa-plus-circle"></i></a>
</div>
<table id="hoteltable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID Hotel</th>
            <th>Hotel Name</th>
            <th>Location</th>
            <th>Rating</th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach($students as $student)
        <tr>
            <td>{{ $student['id'] }}</td>
            <td>{{ $student['name'] }}</td>
            <td>{{ $student['age'] }}</td>
            <td>
                <a href="/students/editstudent/{{ $student['id']}}">Edit</a>
                <a href="/students/deletestudent/{{ $student['id']}}">Delete</a>
            </td>
        </tr>
        @endforeach --}}
    <tfoot>
        <tr>
            <th>ID Hotel</th>
            <th>Hotel Name</th>
            <th>Location</th>
            <th>Rating</th>
        </tr>
    </tfoot>
</table>
@endsection
