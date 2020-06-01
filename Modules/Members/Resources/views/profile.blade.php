@extends('members::layouts.master')
@section('cssonpage')
    <link rel="stylesheet" href="/modules/members/plugins/jquery-validator/css/screen.css">
@endsection
@section('content')
    <div class="container mt-2" id="demo">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form name="edit_profile_form" method="POST" enctype="multipart/form-data" action="{{ route('member.profile')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Full Name</label>
                                        <input type="text" class="form-control @error('fullname') error @enderror" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" name="fullname" value="{{ $user->name }}">
                                        @error('fullname')
                                            <label id="fullname-error" class="error" for="fullname">{{ $message }}</label>
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
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control @error('email') error @enderror" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" name="email" value="{{ $user->email }}">
                                        @error('email')
                                            <label id="email-error" class="error" for="email">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" class="form-control  @error('phone_number') error @enderror" name="phone_number" value="{{ $user->mobile_phone }}">
                                        @error('phone_number')
                                            <label id="phone_number-error" class="error" for="phone_number">{{ $message }}</label>
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
                                        <label for="image_picture">Photo Profile</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="profile_picture">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group pull-right">
                                        <button class="btn btn-sm btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsonpage')
    <script src="/modules/members/plugins/jquery-validator/dist/jquery.validate.min.js"></script>
    <script>
        $(function() {
            $('form[name="edit_profile_form"]').validate({
                rules: {
                    fullname: "required",
                    email: {
                        required: true,
                        email:  true
                    }
                }
            })
            $('input[type="file"]').change(function(e){
                var fileName = e.target.files[0].name;
                $('label[for="validatedCustomFile"]').html(fileName)
            });
        })
    </script>
@endsection