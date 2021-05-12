@extends('pages/app')

@section('title', 'Hotel')
@yield('script')
@section('content')
<p class="text-center" style="font-size: 36px">User List</p>
<script>
    $(document).ready(function () {
        $('#usertable').DataTable();
    });
</script>
<a type="button" href="{{ url('admin/users/add_view') }}" class="btn btn-warning">Add User</a>
{{-- <a type="button" href="{{ url('admin/hotels/add_view') }}" class="btn btn-warning">User Page</a> --}}

<div class="container-fluid">
    <table id="usertable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID User</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Birthdate</th>
                <th>Phone Number</th>
                <th>Link Photo</th>
                <th>Role</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user['id_user'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['password'] }}</td>
                <td>{{ $user['birthdate'] }}</td>
                <td>{{ $user['phone_number'] }}</td>
                <td>{{ $user['link_photo'] }}</td>
                <th>{{ $user['id_role'] }}</th>
                <td>
                    <a type="button" href="{{ url('admin/users/edit_view/'.$user['id_user']) }}" class="btn btn-warning">Edit</a>
                    <a type="button" href="{{ url('admin/users/delete/'.$user['id_user']) }}" class="btn btn-warning">Delete</a>
                </td>
            </tr>
            @endforeach
        <tfoot>
            <tr>
                <th>ID User</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Birthdate</th>
                <th>Phone Number</th>
                <th>Link Photo</th>
                <th>Role</th>
                <th>Details</th>
            </tr>
        </tfoot>
    </table>
    
</div>
@endsection
