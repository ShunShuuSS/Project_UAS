@extends('pages/app')

@section('content')

<div class="container">
    <form action="{{ url('admin/hotels/edit/'.$edithotel['id_hotel']) }}" method="POST" enctype="multipart/form-data">
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
            <label for="name" class="form-label">Hotel ID Location</label>
            <select class="form-control custom-select-sm" name="id_location">
                @foreach($locations as $location)
                    <option value="{{ $location->id_location }}" {{ $location->id_location == $hotel_location['id_location'] ? 'selected' : '' }}>{{ $location->id_location }}</option>
                @endforeach
            </select>
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

        <div class="mb-3">
            <label for="age" class="form-label">Description <span class="fw-light">Optional</span></label>
            <input type="text" class="form-control" name="description" placeholder="" value="{{ $edithotel['description'] }}" maxlength="255">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Hotel Picture <span class="fw-light">Optional</span></label>
            <input type="file" class="form-control" name="image_link" placeholder="" value="">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

@endsection
