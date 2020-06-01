@extends('members::layouts.master')

@section('content')
<div class="container">
    <section class="bread">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">members</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    vendor suggestion
                </li>
            </ol>
        </nav>
    </section>

    <section class="mb-5 vendor-list">
        @php
            $i = 1;
        @endphp
        @foreach ($vendors as $vendor)
            @if ($i == 1)
                <div class="row">                
            @endif
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="bg-img-banner">
                            @php
                                $banner = "/modules/members/img/vendor1.jpg";
                                $public_path = public_path("/images/vendor");
                                if (file_exists($public_path . "/thumbnail_vendor_".$vendor->id."_banner.png")) {
                                    $banner = "/images/vendor/thumbnail_vendor_".$vendor->id."_banner.png";
                                }
                            @endphp
                            <img src="{{ $banner }}" alt="">
                        </div>
                        <div class="avatar block">
                            <a href="{{ route('member.vendor', ['slug' => $vendor->vendor_slug ]) }}">
                                @php
                                    $img = "/modules/members/img/vendor1.jpg";
                                    if (file_exists($public_path . "/thumbnail_vendor_".$vendor->id."_photo.jpeg")) {
                                        $img = "/images/vendor/thumbnail_vendor_".$vendor->id."_photo.jpeg";
                                    }
                                @endphp
                                <img src="{{ $img }}" alt="" width="50">
                            </a>
                        </div>

                        <div class="clear" style="height: 27px;"></div>
                        <div class="vendor-name">
                            <a href="{{ route('member.vendor', ['slug' => $vendor->vendor_slug ]) }}">
                                <h4>{{ $vendor->vendor_name }}</h4>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="vendor-shown-photos">
                            @php
                                $x = 1;
                                $countPhoto = 0;
                            @endphp
                            @foreach ($vendor->albums as $album)
                                @if ($x < 3)
                                    <li>
                                        <img src="/images/wedding/banner/{{ $album->banner_album }}" border="0" width="60" class="avatar">
                                    </li>    
                                @endif
                                @php
                                    $x++;
                                    $countPhoto += $album->photos->count();
                                @endphp
                            @endforeach 

                            <li class="count">
                                <a href="#">{{ $countPhoto }}</a>
                                <br> Photos
                            </li>
                        </ul>
                    </div>

                    <div class="card-footer">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
            </div>
            @if ($i%4 == 0 && $i !== 1)
                </div>
                <div class="row">
            @endif
            @php
                $i++;
            @endphp
        @endforeach
    </section>
</div>
@endsection