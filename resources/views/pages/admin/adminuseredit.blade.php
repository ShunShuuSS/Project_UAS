@extends('pages/app')

@section('content')
<script>

</script>


<div class="container">
    <form action="{{ url('admin/users/edit/'.$useredit['id_user']) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Type hotel name" value="{{ $useredit['name'] }}">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Email</label>
            <input type="text" name="email" value="{{ $useredit['email'] }}" hidden>
            <input type="text" class="form-control" placeholder="Type email" value="{{ $useredit['email'] }}" disabled>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="***********" value="">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Birthdate</label>
            <input type="date" class="form-control" name="birthdate" placeholder="" value="<?php echo date('Y-m-d',strtotime($useredit['birthdate'])) ?>">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Phone Number</label>
            <input type="Number" class="form-control" name="phone_number" placeholder="Type phonenumber" value="{{ $useredit['phone_number'] }}">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Link photo</label>
            <input type="file" class="form-control" name="link_photo" placeholder="" value="{{ $useredit['link_photo'] }}">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Role</label>

            <select class="form-control custom-select-sm" name="id_role">
                {{-- <option disabled="disabled" selected>Choose user role...</option> --}}
                <?php $options = $useredit->id_role ?>
                @foreach($roleedit as $role)
                    <option value="{{ $role->id_role }}" <?php if($options==$role->id_role) echo 'selected="selected"'; ?>>{{ $role->name }}</option>
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
