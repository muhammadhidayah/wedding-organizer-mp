@extends('members::layouts.master')

@section('content')
<div class="container">
    <section class="bread">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">home</a></li>
                <li class="breadcrumb-item"><a href="#">wedding vendors</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    list all product
                </li>
            </ol>
        </nav>
    </section>
</div>

<section class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    @php
                        $photo = "/modules/members/img/vendor1.jpg";
                        $public_path = public_path("/images/vendor");
                        if (file_exists($public_path . "/vendor_".$vendor->id."_photo.jpeg")) {
                            $photo = "/images/vendor/vendor_".$vendor->id."_photo.jpeg";
                        }
                    @endphp
                    <img class="card-img-top" src="{{ $photo }}" alt="Card image cap">
                    <div class="card-body">
                        <span>{{ $vendor->vendor_address }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row pb-4">
                    <div class="col-md-12">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    @php
                                        $banner = "/modules/members/img/wedding1.jpg";
                                        $public_path = public_path("/images/vendor");
                                        if (file_exists($public_path . "/thumbnail_vendor_".$vendor->id."_banner.png")) {
                                            $banner = "/images/vendor/thumbnail_vendor_".$vendor->id."_banner.png";
                                        }
                                    @endphp
                                    <img class="d-block w-100" src="{{ $banner }}" alt="First slide" style="height: 340px;">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav justify-content-center" style="margin-bottom: 13px;">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#nav-real-wedding">Real Wedding</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#nav-package">Package</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#nav-promo">Promo</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#nav-review">Review</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#nav-about">About</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-real-wedding" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            @foreach ($vendor->albums as $album)
                                <div class="col-md-2">
                                    <a href="/images/wedding/banner/{{ $album->banner_album }}" data-gallery="gallery-{{ $album->id }}">
                                        <img src="" alt="">
                                    </a>
                                    @foreach ($album->photos as $photo)
                                        <div data-toggle="lightbox" data-gallery="gallery-{{ $album->id }}" data-remote="/images/wedding/photos/{{ $photo->photo }}" data-title="Hidden item 1"></div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>                        
                    </div>

                    <div class="tab-pane fade" id="nav-package" role="tabpanel" aria-labelledby="nav-package-tab">
                        <div class="row">
                            <div class="col-md-12">
								@foreach ($vendor->packages as $package)
								<div class="card mt-4">
                                    <div class="card-body text-center" id="cardPackage">
                                        <div class="row">
                                            <div class="col-md-8 mt-3 text-left">
                                                <h6>{{ $package->title_package }}</h6>
                                                <p>Rp. {{ $package->price_package }}</p>
                                            </div>
                                            <div class="col-md-4 buttonBuyPackage">
                                                <button type="button" class="btn btn-success"   id="buyPackage" onclick="showModalOrder({{$vendor->id}}, {{ $package->id}})">
                                                    Buy Package
                                                    <span><i class="fa fa-plus"></i></span>
                                                </button> <br>
                                                <button onclick="showDetailPackage('{{ $vendor->id }}', '{{ $package->id}}')" class="btn btn-primary" style="border-radius: 40px">
                                                    Detail <i class="fa fa-info"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								@endforeach
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-promo" role="tabpanel" aria-labelledby="nav-promo-tab">
						<div class="row">
							<div class="col-md-12">
								<ul>
									@foreach ($vendor->promos as $promo)
										<li>
											{{ $promo->title_promo}}
											<p>
												{{ $promo->discount_promo }}%
											</p>
											<p>
												{{ $promo->start_date }} - {{ $promo->end_date }}
											</p>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>

                    <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">Review</div>

                    <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">{{ $vendor->vendor_about }}</div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="buyPackageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLongTitle">Buy Package</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form name="buy_package_form">
				<input type="hidden" name="vendor_id">
				<input type="hidden" name="package_id">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" name="name" class="form-control" placeholder="Name" value="{{ Auth::user()->name }}" disabled>
					</div>
					<div class="form-group">
						<input type="date" required name="wedding_date" class="form-control" placeholder="Date">
					</div>
					<div class="form-group">
						<textarea class="form-control" required id="exampleFormControlTextarea1" name="address" rows="3" placeholder="Address"></textarea>
					</div>
					<div class="form-group">
						<input type="numberPhone" name="numberPhone" class="form-control" placeholder="Number Phone" value="{{ Auth::user()->mobile_phone }}" disabled>
					</div>
					{{-- <div class="form-group">
						<input type="promoCode" name="promoCode" class="form-control" placeholder="Promo Code">
					</div> --}}
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</form>

		</div>
	</div>
</div>

<div class="modal fade" id="modal_detail_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Package</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('cssonpage')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
@endsection

@section('jsonpage')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
    <script>
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

			$('#buyPackageModal').on("hidden.bs.modal", function(e) {
				$(this)
				.find("input,textarea,select")
					.val('')
						.end()
				.find("input[type=checkbox], input[type=radio]")
					.prop("checked", "")
						.end();
			})

			$('form[name="buy_package_form"]').on('submit', function(e) {
				e.preventDefault()
				var data = $(this).serialize()
				$.ajax({
					type: "POST",
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "{{ route('member.order') }}",
					data: data,
					success: (resp) => {
						alert("success");
						$('#buyPackageModal').modal('hide')
					},
					error: (resp) => {
						alert("Ooppss, Something goes wrong!")
					}
				})
			})
        })

		function showModalOrder(vendor_id, package_id) {
			$('#buyPackageModal').modal('show')
			$('input[name="vendor_id"]').val(vendor_id)
			$('input[name="package_id"]').val(package_id)
		}

        function showDetailPackage(vendor_id, package_id) {
            $('#modal_detail_package').modal('show');
            var url = "{{ route('package.detail', ':id')}}"
            url = url.replace(":id", package_id)
            $.ajax({
                url: url,
                type: "GET",
                success: (resp) => {
                    $('#modal_detail_package > div > div > div.modal-body').html(resp)
                }
            })
        }


    </script>
@endsection