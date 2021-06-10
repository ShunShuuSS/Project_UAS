<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel</title>

    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

    <link rel="stylesheet" href="{{ url('resources/assets/css/app.css') }}">
    
    <!-- Profile -->
    <link rel="stylesheet" href="{{ url('resources/profile/css/main.css') }}" />
    
    {{-- Sweel Alert 2 --}}
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Font Awesome Kit --}}
    <link href="{{ url('resources/sidenav/css/styles.css') }}" rel="stylesheet" />
    
    <link rel="icon" type="image/x-icon" href="{{ url('resources/sidenav/assets/favicon.ico') }}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <script src="https://kit.fontawesome.com/2ae0411939.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="bg-light">
                <a class="nav-link sidebar-heading border-bottom text-dark" href="{{ url('home') }}">Hotel</a>
            </div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('profile') }}">Profile</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('booking_list') }}">Booking List</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('aboutus') }}">About Us</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item active"><a class="nav-link" href="{{ url('home') }}">Home</a></li>
                            <li class="nav-item active"><a class="nav-link" href="{{ url('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            @yield('content')
        </div>
    </div>
    
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ url('resources/sidenav/js/scripts.js') }}"></script>

</body>

</html>
