@extends('admin::layouts.master')


@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Config</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Config</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->     

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form  enctype="multipart/form-data" method="POST" action="{{ route('admin.config') }}" >
                    <input type="hidden" name="id" value="{{ $config->id }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="app_name">Application Name</label>
                                <input type="text" class="form-control" name="app_name" value="{{ $config->app_name }}">
                            </div>
                            <div class="form-group">
                                <label for="app_about">About</label>
                                <textarea name="app_about" class="form-control" id="" cols="30" rows="4">{{ $config->app_about }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ $config->phone_number }}">
                            </div>
                            <div class="form-group">
                                <label for="app_address">Address</label>
                                <textarea name="app_address" class="form-control" id="" cols="30" rows="4">{{ $config->app_address }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputFile">Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="logo_app">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection