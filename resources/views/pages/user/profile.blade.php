@extends('pages/app-user')

@section('content')

<div class="p-t-100 p-b-50">
    <div class="wrapper wrapper--w900">
        <div class="card card-6">
            {{-- <div class="card-heading bg-dark">
                <h2 class="title">Apply for job</h2>
            </div> --}}

            <form id="form_profile" method="POST" action="{{ url('profile/edit') }}" enctype="multipart/form-data">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="form-row">
                        <div class="name">Full name</div>
                        <div class="value">
                            <input class="input--style-6" type="text" id="full_name" name="name" value="{{ $user['name'] }}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Email</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-6" type="email" id="email" name="email" placeholder="example@email.com" value="{{ $user['email'] }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Birthdate</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-6" type="date" id="birthdate" name="birthdate" value="{{ $user['birthdate'] }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Phonenumber</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-6" type="text" id="phone_number" name="phone_number" placeholder="example@email.com" value="{{ $user['phone_number'] }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Profile Picture</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-6" type="file" id="phone_number" name="link_photo" value="{{ $user['link_photo'] }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Password</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-6" id="password" type="password" name="password" placeholder="Kosongkan jika tidak mengubah password" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Confirm Password</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-6" id="confirm_password" type="password" name="password_confirmation" placeholder="Kosongkan jika tidak mengubah password" disabled>
                            </div>
                            <p id="alert_konfirmasi_password" class="text-danger" hidden>Konfirmasi password berbeda</p>
                        </div>
                    </div>
                    {{-- <div class="form-row">
                        <div class="name">Upload CV</div>
                        <div class="value">
                            <div class="input-group js-input-file">
                                <input class="input-file" type="file" name="file_cv" id="file">
                                <label class="label--file" for="file">Choose file</label>
                                <span class="input-file__info">No file chosen</span>
                            </div>
                            <div class="label--desc">Upload your CV/Resume or any other relevant file. Max file size 50
                                MB</div>
                        </div>
                    </div> --}}
                </div>
                <div class="card-footer">
                    <button id="btn_edit" class="btn btn--radius-2 btn--blue-2" onclick="return false">Edit</button>
                    <button id="btn_save" class="btn btn--radius-2 btn--blue-2" type="submit" onclick="//return submit_form_profile()" hidden>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var edit_mode = false;
    $('#btn_edit').click(function(){
        if(edit_mode === false){
            edit_mode = true;
            $('#btn_save').prop("hidden", false);
            $('#form_profile input').prop("disabled", false);
            $('#form_profile input#email').prop("disabled", true);
        }else{
            edit_mode = false;
            $('#btn_save').prop("hidden", true);
            $('#form_profile input').prop("disabled", true);
        }
    });
    // $('#form_profile').submit(function(){
    //     event.preventDefault();
    //     return submit_form_profile():
    // })
    // function submit_form_profile(){
    //     var ok = true;
    //     var full_name = $('#full_name').val();
    //     // var email = $('#email').val();
    //     var birthdate = $('#birthdate').val();
    //     var phone_number = $('#phone_number').val();
    //     var password = $('#password').val();
    //     var confirm_password = $('#confirm_password').val();

    //     if(full_name == ''){
    //         $('#full_name').addClass('input-salah');
    //         ok = false;
    //     }else{
    //         $('#full_name').removeClass('input-salah');
    //     }

    //     // if(email == ''){
    //     //     $('#email').addClass('input-salah');
    //     //     ok = false;
    //     // }else{
    //     //     $('#email').removeClass('input-salah');
    //     // }

    //     if(phone_number == ''){
    //         $('#phone_number').addClass('input-salah');
    //         ok = false;
    //     }else{
    //         $('#phone_number').removeClass('input-salah');
    //     }

    //     if(password != ''){
    //         if(password != confirm_password){
    //             $('#confirm_password').addClass('input-salah');
    //             $('#alert_konfirmasi_password').prop('hidden', false);
    //             ok = false;
    //         }else{
    //             $('#confirm_password').removeClass('input-salah');
    //             $('#alert_konfirmasi_password').prop('hidden', true);
    //             ok = false;
    //         }
    //     }

    //     if(ok == false){
    //         return false;
    //     }
    //     $('#form_profile').submit();
    // }
</script>

@endsection
