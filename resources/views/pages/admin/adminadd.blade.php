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
    <form action="{{ url('admin/hotels/add') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Hotel Name </label>
            <input type="text" class="form-control" name="name" placeholder="Type hotel name" value="">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Location </label>

            <select class="form-control custom-select-sm" name="id_location">
                <option disabled="disabled" selected>Choose your location...</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id_location }}">{{ $location->location }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Room Quntity</label>
            <input type="number" class="form-control" name="room_quantity" placeholder="Quantity" value="">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Price/day</label>
            <input type="number" class="form-control" name="price" placeholder="Price/Day" value="">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Pick hotel facility</label> <br>
            <?php $index = 0; ?>
            @foreach ($facilities as $facility)
                <input type="checkbox" class="" name="facility{{ $index++ }}" placeholder="Pick hotel facility" value="{{ $facility->id_facility }}"> {{ $facility->name }} <br>
            @endforeach
            <input type="hidden" name="count_facility" value="{{ count($facilities) }}">
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
