@extends('members::layouts.master')

@section('cssonpage')
    <link rel="stylesheet" href="/modules/members/plugins/jquery-validator/css/screen.css">
@endsection

@section('content')
<div class="container mt-2" id="demo">
    <div class="row" id="navAddVendor">
        <div class="col-md-2"></div>
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5>User Registration</h5>
                    <small id="emailHelp" class="form-text text-muted">Get Started! Enter Your Booking
                        Information</small>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>

        <div class="col-md-2"></div>
        <div class="col-md-8 text-center mb-3">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Account Information</h5>
                    <small id="emailHelp" class="form-text text-muted">You will use this email and password to
                        login!</small>
                </div>
                <div class="card-body text-left">
                    <form name="register_form" method="POST" action="{{ route('member.register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Full Name</label>
                            <input type="text" class="form-control @error('fullname') error @enderror" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="fullname" value="{{ old('fullname') }}">
                            @error('fullname')
                                <label id="fullname-error" class="error" for="fullname">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control @error('email') error @enderror" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
                            @error('email')
                                <label id="email-error" class="error" for="email">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control  @error('phone_number') error @enderror" name="phone_number" value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <label id="phone_number-error" class="error" for="phone_number">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') error @enderror" name="password" id="password">
                            @error('password')
                                <label id="password-error" class="error" for="password">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') error @enderror" name="password_confirmation">
                            @error('password_confirmation')
                                <label id="password_confirmation-error" class="error" for="password_confirmation">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="type_user">User Type</label>
                            
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="type_user_vendor" name="type_user" value="vendor" class="custom-control-input">
                            <label class="custom-control-label" for="type_user_vendor">Vendor</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="type_user_customer" name="type_user" value="customer" class="custom-control-input">
                            <label class="custom-control-label" for="type_user_customer">Customer</label>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection

@section('jsonpage')
<script src="/modules/members/plugins/jquery-validator/dist/jquery.validate.min.js"></script>
<script>    
    $(function() {
        $('form[name="register_form"]').validate({
            rules: {
                fullname: "required",
                email: {
                    required: true,
                    email:  true
                },
                password : {
                    required: true,
					minlength : 8
				},
				password_confirmation : {
					minlength : 8,
                    required: true,
					equalTo : "#password"
				}
            }
        })
    })
</script>
@endsection