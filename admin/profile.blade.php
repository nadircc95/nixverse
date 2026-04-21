@extends('admin.layouts.base')

@section('title', "")

@include('admin.layouts.script_logic')

@section('content')
<div class="row g-0">
    <div class="col-lg-8 pe-lg-2">
        <div class="card mb-3" id="ProfileSettingsCard">
            <div class="card-header">
              <h5 class="mb-0">Profile Settings</h5>
            </div>
            <div class="card-body bg-light">
              <form class="row g-3 form" method="POST" action="#" id="ProfileSettingsForm">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="first-name">First Name</label>
                        <input class="form-control" id="first-name" type="text" value="{{$user->name}}" name="firstname" required="required"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="last-name">Last Name</label>
                        <input class="form-control" id="last-name" type="text" value="{{$user->lastname}}" name="lastname" required="required"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="email1">Email</label>
                        <input class="form-control" id="email1" type="text" value="{{$user->email}}" name="email" required="required" readonly/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="email2">Phone</label>
                        <input class="form-control" id="email2" type="text" value="{{$user->phone}}" name="phone" required="required"/>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <button class="btn btn-primary" type="submit" form="ProfileSettingsForm">Update </button>
                </div>
              </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 ps-lg-2">
        <div class="sticky-sidebar">
            <div class="card mb-3" id="ChangePasswordCard">
                <div class="card-header">
                  <h5 class="mb-0">Change Password</h5>
                </div>
                <div class="card-body bg-light">
                  <form method="POST" action="#" class="form" id="ChangePasswordForm">
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label" for="old-password">Old Password</label>
                            <input class="form-control" id="old-password" name="password_old" type="password" minlength="6" maxlength="20" required="required"/>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label" for="new-password">New Password</label>
                            <input class="form-control" id="new-password" name="password" type="password"  minlength="6" maxlength="20" required="required"/>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label" for="confirm-password">Confirm Password</label>
                            <input class="form-control" id="confirm-password" name="password_confirmation" type="password"  minlength="6" maxlength="20" required="required"/>
                        </div>
                    </div>
                    <button class="btn btn-primary d-block w-100" type="submit" form="ChangePasswordForm">Update Password </button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script_add')
<script>
    if (window.jQuery) {
        var $ = window.jQuery;
        $(async function(){
            $(`#header_menu`).find(".title_ams").addClass("text-primary").html("Welcome {{Auth::user()->name}}");

            let _card_reset_password = $(`#ChangePasswordCard`);

            $.validator.addMethod("checkPassword", function (val, ele, arg) {
                let _password = _card_reset_password.find(`form input[name="password"]`).val();
                let _password_confirmation = _card_reset_password.find(`form input[name="password_confirmation"]`).val();
                if(_password !== _password_confirmation){
                    return false;
                }
                return true;
            }, "Please choose a password confirmation.");

            $('#ChangePasswordForm').validate({
                submitHandler: function (form, event) {
                    event.preventDefault();
                    let urlAction = `{{route('profile.reset_password')}}`;
                    let formData = new FormData(form);

                    swalWithBootstrapButtons.fire({
                        title: 'Kirim Data Ini?',
                        text: "Klik Tombol Yes Jika Data Sudah Benar",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        reverseButtons: true
                    }).then(async (result) => {
                        if (result.isConfirmed) {

                            let button_action = _card_reset_password.find(`form button[type="submit"]`);

                            button_action.prop('disabled', true);

                            let innerBefore = button_action.html();
                            button_action.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait...`);

                            let _post = await postData(urlAction, formData);
                            // console.log(_post);
                            button_action.html(innerBefore);
                            button_action.prop('disabled', false);
                            if(_post.error){
                                errorPost(_post, _card_reset_password, true);
                                return;
                            }

                            successPost(_post, _card_reset_password, true);
                        }
                    });
                },
                ignore: false,
                rules: {
                    password_confirmation: {
                        checkPassword: true,
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('#ChangePasswordForm').validate({
                submitHandler: function (form, event) {
                    event.preventDefault();
                    let urlAction = `{{route('profile.reset_password')}}`;
                    let formData = new FormData(form);

                    swalWithBootstrapButtons.fire({
                        title: 'Kirim Data Ini?',
                        text: "Klik Tombol Yes Jika Data Sudah Benar",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        reverseButtons: true
                    }).then(async (result) => {
                        if (result.isConfirmed) {

                            let button_action = _card_reset_password.find(`form button[type="submit"]`);

                            button_action.prop('disabled', true);

                            let innerBefore = button_action.html();
                            button_action.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait...`);

                            let _post = await postData(urlAction, formData);
                            // console.log(_post);
                            button_action.html(innerBefore);
                            button_action.prop('disabled', false);
                            if(_post.error){
                                errorPost(_post, _card_reset_password, true);
                                return;
                            }

                            successPost(_post, _card_reset_password, true);
                        }
                    });
                },
                ignore: false,
                rules: {
                    password_confirmation: {
                        checkPassword: true,
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            let _card_profile_settings = $(`#ProfileSettingsCard`);
            $('#ProfileSettingsForm').validate({
                submitHandler: function (form, event) {
                    event.preventDefault();
                    let urlAction = `{{route('profile.profile_settings')}}`;
                    let formData = new FormData(form);

                    swalWithBootstrapButtons.fire({
                        title: 'Kirim Data Ini?',
                        text: "Klik Tombol Yes Jika Data Sudah Benar",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        reverseButtons: true
                    }).then(async (result) => {
                        if (result.isConfirmed) {

                            let button_action = _card_profile_settings.find(`form button[type="submit"]`);

                            button_action.prop('disabled', true);

                            let innerBefore = button_action.html();
                            button_action.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait...`);

                            let _post = await postData(urlAction, formData);
                            // console.log(_post);
                            button_action.html(innerBefore);
                            button_action.prop('disabled', false);
                            if(_post.error){
                                errorPost(_post, _card_profile_settings, true);
                                return;
                            }
                            successPost(_post, _card_profile_settings, true, false);
                        }
                    });
                },
                ignore: false,
                rules: {

                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    }
</script>
@endpush

