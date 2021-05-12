@extends('pages/app')

@section('content')

<div class="container">
    <form action="{{ url('admin/hotels/room/edit/'.$editroom['id_room']) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">ID Room </label>
            <input disabled="disabled" class="form-control" name="id_room" value="{{ $editroom['id_room'] }}">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">ID Hotel </label>
            <input disabled="disabled" class="form-control" name="id_hotel" value="{{ $editroom['id_hotel'] }}">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">ID Room Type</label>
            <input type="text" class="form-control" name="id_room_type" placeholder="id room type" value="{{ $editroom['id_room_type'] }}">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Price/day</label>
            <input type="text" class="form-control" name="price_per_day" placeholder="price/day" value="{{ $editroom['price_per_day'] }}">
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

@endsection
