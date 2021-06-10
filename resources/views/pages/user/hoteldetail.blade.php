@extends('pages/app-user')

@section('content')

<div class="container">
  <div class="card mt-5">
    <div class="card-body">
      <a class="btn btn-success" href="{{ url('home') }}">Back</a>
      <h1>{{ $hotel['name'] }}</h1>
      <img class="img-fluid" src="{{ $hotel['image_link'] }}" alt="">
      <div class="rateyo" data-rateyo-rating="{{ $hotel['rating'] }}" data-rateyo-num-stars="5" data-rateyo-score="{{ $hotel['rating'] }}"></div>
      <h4>{{ $hotel['location'] }}</h4>
      <p>{{ $hotel['description'] }}</p>
      @if (count($facilities) > 0)
        <p>Fasilitas</p>
        <ul>
          @foreach ($facilities as $facility)
            <li>{{ $facility->facility_name }}</li>
          @endforeach
        </ul>
      @endif
  </div>
</div>

<script>
    $(".rateyo").rateYo({
        normalFill: "#A0A0A0",
        starWidth: "25px",
        readOnly: true //--GUNAKAN INI JIKA INGIN DIBUAT DISABLE--
    });
</script>
@endsection