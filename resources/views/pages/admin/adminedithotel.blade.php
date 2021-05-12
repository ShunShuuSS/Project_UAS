@extends('pages/app')

@section('content')

<div class="container">
    <form action="{{ url('admin/hotels/edit/'.$edithotel['id_hotel']) }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Hotel ID </label>
            <input disabled="disabled" class="form-control" name="id_hotel" value="{{ $edithotel['id_hotel'] }}">
        </div>
        
        <div class="mb-3">
            <label for="name" class="form-label">Hotel Name </label>
            <input type="text" class="form-control" name="name" placeholder="name" value="{{ $edithotel['name'] }}">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Hotel ID Location</label>
            <input type="text" class="form-control" name="id_location" placeholder="location id"
                value="{{ $edithotel['id_location'] }}">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Room Quantity</label>
            <input type="text" class="form-control" name="room_quantity" placeholder="room quantity"
                value="{{ $edithotel['room_quantity'] }}">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" placeholder="price"
                value="{{ $edithotel['price'] }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

@endsection
