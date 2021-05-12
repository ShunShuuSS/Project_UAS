@extends('pages/app')

@section('content')
<script>
    // $(document).ready(function () {
    //     $('select').selectize({
    //         sortField: 'text'
    //     });
    // });

</script>


<div class="container">
    <form action="{{ url('admin/users/add') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Type hotel name" value="">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" placeholder="Type hotel name" value="">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" placeholder="Type hotel name" value="">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Birthdate</label>
            <input type="date" class="form-control" name="birthdate" placeholder="Type hotel name" value="">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Phone Number</label>
            <input type="Number" class="form-control" name="phone_number" placeholder="Type hotel name" value="">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Link photo</label>
            <input type="file" class="form-control" name="link_photo" placeholder="Type hotel name" value="">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Role</label>

            <select class="form-control custom-select-sm" name="id_role">
                <option disabled="disabled" selected>Choose user role...</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id_role }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3" style="padding-top: 10px">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        @foreach ($errors->all() as $item)
            <p>{{ $item }}</p>
        @endforeach
    </form>
</div>

@endsection
