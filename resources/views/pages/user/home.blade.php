@extends('pages/app-user')

@section('content')
<div class="container">
    <div class="mt-3">
        <form class="d-flex">
            @csrf
            <input id="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn bg-dark text-white" type="button" onclick="filterBar()">Filter</button>
        </form>
    </div>
    <div id="filter" class="mt-2">
        <form class="d-flex flex-row-reverse">
            @csrf
            <div class="ms-1">
                <a class="btn bg-dark text-white" href="{{ url('home/filter') }}"><i class="fas fa-star"></i> 3 keatas</a>
            </div>
            <div class="ms-1">
                <button class="btn bg-dark text-white" type="button" onclick="filterBar2()">Lokasi</button>
            </div>
        </form>
    </div>
    <div id="filterlokasi" class="mt-2">
        <form class="d-flex flex-row-reverse">
            @csrf
            @foreach ($locations as $location)
            <div class="ms-1">
                <button class="btn bg-warning text-black" type="button" onclick="filterBar2()">{{ $location['location'] }}</button>
            </div>
            @endforeach
        </form>
    </div>
    <!-- Page Heading -->
    <h1 class="mb-4 text-gray-800 text-center">Hotel List</h1>

    <div class="row">
        @foreach ($hotels as $hotel)
        <div class="col-auto search-area">
            <div class="card" style="width: 18rem;">
                <img src="{{ $hotel['image_link'] }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $hotel['name'] }}</h5>
                    <p class="card-text">
                        <div class="rateyo" data-rateyo-rating="{{ $hotel['rating'] }}" data-rateyo-num-stars="5"
                            data-rateyo-score="{{ $hotel['rating'] }}"></div>
                    </p>
                    <p class="card-text">Rp. {{ $hotel['price'] }}/day</p>
                    <a href="{{ url('hotel/'.$hotel['id_hotel']) }}" class="btn btn-secondary">Details</a>
                    <a href="{{ url('booking/'.$hotel['id_hotel']) }}" class="btn btn--green">Book</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- /.container-fluid -->

<script>
    $(".rateyo").rateYo({
        normalFill: "#A0A0A0",
        starWidth: "25px",
        readOnly: true //--GUNAKAN INI JIKA INGIN DIBUAT DISABLE--
    });

    $(document).ready(function () {
        $("#search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $(".search-area").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $("#filter").hide();
    $("#filterlokasi").hide();

    function filterBar() {
        
        var x = document.getElementById("filter");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function filterBar2() {
        
        var x = document.getElementById("filterlokasi");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

</script>
<!-- End of Main Content -->

@endsection
