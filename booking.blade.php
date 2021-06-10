@extends('pages/app-user')

@section('content')

<div class="p-t-100 p-b-50">
    <div class="wrapper wrapper--w900">
        <div class="card card-6">
            <div class="card-body">
                <form id="form_profile" method="POST" action="{{ url('/booking') }}">
                    @csrf
                    <input type="text" name="id_hotel" value="{{ $hotel['id_hotel'] }}" hidden>
                    <div class="form-row">
                        <div class="n{{ ame">Nama Hotel</div> }}
                        <div class="value">
                            <input class="input--style-6" type="text" id="full_name" name=""
                                value="{{ $hotel['name'] }}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Nama Pemesan</div>
                        <div class="value">
                            <input class="input--style-6" type="text" id="full_name" name="name" value="{{ $user['name'] }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">No. Telp</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-6" type="number" id="" name="phonenumber"
                                    placeholder="08123456789" value="{{ $user['phone_number'] }}" minlength="8" min="6">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Email</div>
                        <div class="value">
                            <div class="input-group">{{  }}
                                <input class="input--style-6" type="email" id="" name="email"
                                    placeholder="example@email.com" value="{{ $user['email'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Check-in</div>{{  }}
                        <div class="value">
                            <div class="input-group">{{  }}
                                <input class="input--style-6" type="date" id="check_in" name="check_in" value="">
                            </div>
                        </div>
                    </div>
                    {{-- Chechout harus lebih jauh dari checkin --}}
                    <div class="form-row">
                        <div class="name">Check-out</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-6" type="date" id="check_out" name="check_out" value="" onchange="onchangeCheckout()">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Jumlah Kamar</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-6" id="jumlahKamar" type="number" onchange="CalculatePrice()"
                                    name="total_room" value="1" min="1">
                            </div>
                        </div>
                    </div>
                    <input type="number" id="hargaHotel" name="hotel_price" value="{{ $hotel['price'] }}" hidden>
                    <div class="form-row">
                        <div class="name">Harga</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-6" id="totalHarga" type="" name="price"
                                    value="{{ $hotel['price'] }}" min="0" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="" type="submit" class="btn btn--radius-2 btn--blue-2">Pesan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();

        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var mindate = year + '-' + month + '-' + day;
        $('#check_in').attr('min', mindate);
    })
    function CalculatePrice() {
        var jumlahKamar = $('#jumlahKamar').val();
        var hargaHotel = $('#hargaHotel').val();
        var totalPrice = jumlahKamar * hargaHotel;
        $('#totalHarga').val(totalPrice);
    }

    function onchangeCheckout(){
        $('#check_out').attr('min', $('#check_in').val());
    }

</script>

@endsection
