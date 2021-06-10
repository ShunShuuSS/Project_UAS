@extends('pages/app-user')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <h1 class="mb-4 text-gray-800 text-center">Abous Us</h1>

</div>

<div class="card m-5">
    <div class="row">
        <div class="col-md-3" style="height: 200px">
            <img class="col-12" src="{{ url('resources/image/steven.jpg') }}" style="height: 100%; width:100% object-fit: contain">
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <h5 class="card-title">Steven Sanjaya</h5>
                <p class="card-text">NIM : 00000030111</p>
                <p class="card-text">Peran : Back-end Developer</p>
            </div>
        </div>
    </div>
</div>

<div class="card m-5">
    <div class="row">
        <div class="col-md-3" style="height: 200px">
            <img class="col-12" src="{{ url('resources/image/rendra.jpg') }}" style="height: 100%; width:100% object-fit: contain">
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <h5 class="card-title">Janu Rendra NS</h5>
                <p class="card-text">NIM : 00000031273</p>
                <p class="card-text">Peran : Back-end Developer</p>
            </div>
        </div>
    </div>
</div>

<div class="card m-5">
    <div class="row">
        <div class="col-md-3" style="height: 200px">
            <img class="col-12" src="{{ url('resources/image/theo.png') }}" style="height: 100%; width:100% object-fit: contain">
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <h5 class="card-title">Theodore Alvin Hartanto</h5>
                <p class="card-text">NIM : 00000031064</p>
                <p class="card-text">Peran : Front-end Developer</p>
            </div>
        </div>
    </div>
</div>

<div class="card m-5">
    <div class="row">
        <div class="col-md-3" style="height: 200px">
            <img class="col-12" src="{{ url('resources/image/fahmi.jpeg') }}" style="height: 100%; width:100% object-fit: contain">
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <h5 class="card-title">Muhammad Fahmi</h5>
                <p class="card-text">NIM : 00000042206</p>
                <p class="card-text">Peran : Front-end Developer</p>
            </div>
        </div>
    </div>
</div>

@endsection
