@extends('members::layouts.master')

@section('cssonpage')
	<link rel="stylesheet" href="/modules/members/plugins/jquery-validator/css/screen.css">
	<link rel="stylesheet" href="/modules/admin/plugins/daterangepicker/daterangepicker.css">
@endsection

@section('content')
<div class="container" id="demo">
	<div class="row">
		<div class="col-md-12 pt-2 text-center">
			<h2>Manage Vendor</h2>
		</div>
		<div class="col-md-12 mt-4 mb-2">
			<nav>
				<div class="nav nav-tabs mb-2" id="nav-tab" role="tablist">
					<a class="nav-item nav-link active" id="nav-real-tab" data-toggle="tab" href="#nav-real" role="tab"
						aria-controls="nav-real" aria-selected="true">Real Wedding</a>
					<a class="nav-item nav-link" id="nav-package-tab" data-toggle="tab" href="#nav-package" role="tab"
						aria-controls="nav-package" aria-selected="false">Package</a>
					<a class="nav-item nav-link" id="nav-promo-tab" data-toggle="tab" href="#nav-promo" role="tab"
						aria-controls="nav-promo" aria-selected="false">Promo</a>
					<a class="nav-item nav-link" id="nav-orders-vendor-tab" data-toggle="tab" href="#nav-orders-vendor" role="tab"
						aria-controls="nav-orders-vendor" aria-selected="false">Order(s)</a>
					<a class="nav-item nav-link" id="nav-config-tab" data-toggle="tab" href="#nav-config" role="tab"
						aria-controls="nav-config" aria-selected="false">Setting(s)</a>
				</div>
			</nav>

			<div class="tab-content" id="nav-tabContent">
				<div id="nav-real" class="tab-pane fade show active">
					<div class="col-md-12 text-right mt-2 mb-2 pr-0 pl-0">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addReal">
							Add Album
						</button>
					</div>
					<table id="example1" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr role="row">
								<th>Title</th>
								<th>Thumbnail</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>


				<div id="nav-package" class="tab-pane fade">
					<div class="col-md-12 text-right mt-2 mb-2 pr-0 pl-0">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPackage">
							Add Package
						</button>
					</div>
					<table id="example2" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>Package Title</th>
								<th>Description Package</th>
								<th>Price</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>

				<div id="nav-config" class="tab-pane fade">
					<div class="row">
						<div class="col-md-12">
							<fieldset class="border p-2">
								<legend class="w-auto">General</legend>
								<form name="form_edit_vendor" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Vendor Name</label>
												<input type="text" class="form-control" name="vendor_name" value="{{ $vendor->vendor_name}}">
											</div>
											<div class="form-group">
												<label for="">Vendor About</label>
												<textarea name="vendor_about" id="vendor_about" cols="30" rows="3" class="form-control">{{ $vendor->vendor_about}}</textarea>
											</div>
											<div class="form-group">
												<label for="">Vendor Photo</label>
												<div class="custom-file">
													<input type="file" name="vendor_photo" class="custom-file-input" id="vendor_photo">
													<label class="custom-file-label" for="validateCustomeVendorPhoto">Choose file...</label>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Vendor Phone</label>
												<input type="text" value="{{ $vendor->vendor_phone}}" class="form-control" name="vendor_phone">
											</div>
											<div class="form-group">
												<label for="">Vendor Address</label>
												<textarea class="form-control" name="vendor_address" id="vendor_address" cols="30" rows="3">{{ $vendor->vendor_address }}</textarea>
											</div>
											<div class="form-group">
												<label for="">Vendor Banner</label>
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="vendor_banner" name="vendor_banner">
													<label class="custom-file-label" for="validateCustomeVendorBanner">Choose file...</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="pull-right">
												<button class="btn btn-sm btn-success" type="submit">Save</button>
											</div>
										</div>
									</div>
								</form>		
							</fieldset>
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<fieldset class="border p-2">
								<legend class="w-auto">Account Bank</legend>
								<form name="form_register_account_bank">
									@csrf
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="lblAccoutNumber">Account Number</label>
												<input type="text" name="account_number" value="{{ 
													$bankAccount->bank_account_number ?? ''
												}}" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="lblBank">Bank(s)</label>
												<select name="bank_code" id="list_bank" class="form-control">
													@foreach ($listBank as $bank)
														@if (isset($bankAccount) && $bank->id == $bankAccount->bank_id)
															<option value="{{ $bank->id }}" selected> {{ $bank->bank_name}}</option>	
														@else
															<option value="{{ $bank->id }}"> {{ $bank->bank_name}}</option>	
														@endif
														
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="pull-right">
												<button class="btn btn-sm btn-success" type="submit">Save</button>
											</div>
										</div>
									</div>
								</form>
							</fieldset>
						</div>
					</div>
				</div>
				
				<div id="nav-promo" class="tab-pane fade">
					<div class="col-md-12 text-right mt-2 mb-2 pr-0 pl-0">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPromo">
							Add Promo
						</button>
					</div>
					<table id="example3" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>Promo Title</th>
								<th>Discount</th>
								<th>Promo For Package</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>

				<div id="nav-orders-vendor" class="tab-pane fade">
					<div class="row">
						<div class="col-md-2">
							<ul class="nav flex-column">
								<li class="nav-item">
								  <a class="nav-item nav-link active" id="nav-orders-progress-tab" data-toggle="tab" href="#nav-orders-progress" role="tab"
								  aria-controls="nav-orders-progress" aria-selected="true">Progress</a>
								</li>
								<li class="nav-item">
									<a class="nav-item nav-link" id="nav-orders-completed-tab" data-toggle="tab" href="#nav-orders-completed" role="tab"
								  aria-controls="nav-orders-completed" aria-selected="false">Completed</a>
								</li>
							</ul>
						</div>
						<div class="col-md-10">
							<div class="tab-content" id="nav-tab-content-orders">
								<div id="nav-orders-progress" class="tab-pane fade show active">
									<table id="tbl_progress" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Client</th>
												<th>Package</th>
												<th>Wedding Date</th>
												<th>Action</th>
											</tr>
										</thead>
									</table>
								</div>
								<div id="nav-orders-completed" class="tab-pane fade">
									<table id="tbl_completed" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Client</th>
												<th>Package</th>
												<th>Wedding Date</th>
												<th>Action</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Real Wedding -->
<div class="modal fade" id="addReal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLongTitle">Add Album Real Wedding</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form name="create_wedding_albums" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="exampleInputEmail1">Title</label>
								<input type="title" required name="title" class="form-control" placeholder="add title" />
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Choose Thumbnail</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
									</div>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="banner_album">
										<label class="custom-file-label" for="inputGroupFile01"></label>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputEmail1">Add Multiple Photo</label>
							<div>
								<div class="row">
									<div class="col-md-12">
										<div id="dropzone">
											<form class="dropzone needsclick text-center" id="demo-upload" action="{{ route('vendor.add.photo.album') }}" method="POST" enctype="multipart/form-data">
												<div class="row">
													@csrf
													<input type="hidden" name="album_id">
													<div class="col-md-12">
														<div class="dz-message needsclick">
															Drop files here or click to upload.
														</div>
													</div>
												</div>
												
											</form>
										</div>
										<div id="preview-template" style="display: none;">
											<div class="dz-preview dz-file-preview">
												<div class="dz-image"><img data-dz-thumbnail=""></div>
												<div class="dz-details">
													<div class="dz-size"><span data-dz-size=""></span></div>
													<div class="dz-filename"><span data-dz-name=""></span></div>
												</div>
												<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
												<div class="dz-error-message"><span data-dz-errormessage=""></span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="storeWeddingAlbums()" class="btn btn-success" data-dismiss="modal">
					Submit
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Package -->
<div class="modal fade" id="addPackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLongTitle">Add Package</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form name="create_package_form">
				<div class="modal-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Package Title</label>
						<input type="text" name="package_title" required class="form-control" placeholder="add title" />
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Description Package</label>
						<textarea class="form-control" required name="detail_package" id="exampleFormControlTextarea1" rows="5"></textarea>
					</div>
					<label for="exampleInputEmail1">Price</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Rp</span>
						</div>
						<input type="text" required name="price_package" class="form-control" aria-label="Amount (to the nearest rupiah)" />
						<div class="input-group-append">
							<span class="input-group-text">.00</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">
						Submit
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Promo -->
<div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLongTitle">Add Promo</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form name="promo_register_form">
			<div class="modal-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Promo Title</label>
					<input type="title" name="title" class="form-control" placeholder="add title" />
				</div>
				
				<div class="form-group">
					<label for="exampleInputEmail1">Discount</label>
					<div class="input-group mb-3">
						<input type="text" name="discount" class="form-control" aria-label="Amount (to the nearest dollar)" />
						<div class="input-group-append">
							<span class="input-group-text">%</span>
						</div>
					</div>					
				</div>

				<div class="form-group">
					<label for="exampleFormControlSelect1">Link Promo to Packages</label>
					<select class="form-control" id="exampleFormControlSelect1" name="package_list">
						@foreach ($packages as $package)
							<option value="{{ $package->id }}">{{ $package->title_package}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="start_date">Duration Promo</label>
					<div class="input-group" id="duration_promo">
						<div class="input-group-prepend date">
							<span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-calendar"></i></span>
						</div>
						<input type="text" class="form-control pull-right" id="duration_date" name="duration_date">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">
					Submit
				</button>
			</div>
			</form>
		</div>
		
	</div>
</div>

<!-- Modal Detail Order-->
<div class="modal fade" id="modal-detail-order" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLongTitle">Detail Order</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="mdl-body-order">
				
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success btn-default" data-dismiss="modal">
					Close
				</button>
			</div>
		</div>
		
	</div>
</div>

@endsection

@section('jsonpage')
<script src="/modules/members/plugins/jquery-validator/dist/jquery.validate.min.js"></script>
<script src="/modules/members/dropzone/dist/dropzone.js"></script>
<script src="/modules/members/DataTables-1.10.21/js/jquery.dataTables.min.js"></script>
<script src="/modules/members/DataTables-1.10.21/js/dataTables.bootstrap4.js"></script>
<script src="/modules/admin/plugins/daterangepicker/moment.min.js"></script>
<script src="/modules/admin/plugins/daterangepicker/daterangepicker.js"></script>
<script>
	$(document).ready(function () {
		$('#example1').DataTable({
			"ajax": "{{ route('vendor.list.album', ['vendor_id' => $vendor->id] )}}",
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            columns: [
                {
                    data: 'title_photo'
                }, {
                    data: 'banner_album',
					render: (data) => {
						return '<img src="/images/wedding/banner/'+data+'" width="100">'
					}
                }, {
                    data: 'id',
					className: "text-center",
					render: (data) => {
						return '<button class="btn btn-sm btn-danger" onClick=deleteAlbum('+data+')><i class="fa fa-trash"></i></button>'
					}
                }
            ]
		})
		$("#example2").DataTable({
			"ajax": "{{ route('vendor.list.package', ['vendor_id' => $vendor->id] )}}",
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            columns: [
                {
                    data: 'title_package'
                }, {
                    data: 'detail_package',
					render: (data) => {
						return data.slice(0, 300) + " ...."
					}
                }, {
                    data: 'price_package',
					render: (data) => {
						return 'Rp. '+data
					}
                }, {
					data: 'id',
					render: (data) => {
						return '<button class="btn btn-sm btn-danger" onClick="deletePackage('+data+')"><i class="fa fa-trash"></i></button>'
					}
				}
            ]
		});

		$("#example3").DataTable({
			"ajax": "{{ route('vendor.list.promo', ['vendor_id' => $vendor->id] )}}",
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            columns: [
                {
                    data: 'title_promo'
                }, {
                    data: 'discount_promo'
                }, {
                    data: 'packages',
					render: (data) => {
						var list = "<ul>"
						data.forEach((val, ind) => {
							list += "<li>"+val.title_package+"</li>"
						})
						list += "</ul>"

						return list
					}
                }, {
					data: 'id',
					render: (data) => {
						return '<button class="btn btn-sm btn-danger" onClick="deletePromo('+data+')"><i class="fa fa-trash"></i></button>'
					}
				}
            ]
		});

		$('#tbl_progress').DataTable({
			"ajax": "{{ route('vendor.list.order', ['id' => $vendor->id] )}}",
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            columns: [
                {
                    data: 'inv_number'
                }, {
                    data: 'user.name',
                }, {
                    data: 'package.title_package'
                }, {
					data: 'wedding_date'
				}, {
					data: 'id',
					render: (data) => {
						return '<button class="btn btn-sm btn-primary" onClick="detailOrder('+data+')"><i class="fa fa-info-circle"></i></button><button class="btn btn-sm btn-success" onClick="updateOrderCompleted('+data+')"><i class="fa fa-check-square-o"></i></button>'
					}
				}
            ]
		});

		$('#tbl_completed').DataTable({
			"ajax": "{{ route('vendor.list.order', ['id' => $vendor->id] )}}?progress=completed",
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            columns: [
                {
                    data: 'inv_number'
                }, {
                    data: 'user.name',
                }, {
                    data: 'package.title_package'
                }, {
					data: 'wedding_date'
				}, {
					data: 'id',
					render: (data) => {
						return '<button class="btn btn-sm btn-primary" onClick="detailOrder('+data+')"><i class="fa fa-info-circle"></i></button>'
					}
				}
            ]
		});

		$('a[data-toggle="tab"]').on('shown.bs.tab', (e) => {
            if (e.target.id == "nav-tab") {
                $('#example1').DataTable().ajax.reload();
            } else if (e.target.id == 'nav-package-tab') {
                $('#example2').DataTable().ajax.reload();
            } else if (e.target.id == 'nav-promo-tab') {
                $('#example3').DataTable().ajax.reload();
            } else if (e.target.id == 'nav-orders-vendor-tab') {
                $('#tbl_progress').DataTable().ajax.reload();
				$('#tbl_completed').DataTable().ajax.reload();
            } else if (e.target.id == 'nav-orders-progress-tab') {
				$('#tbl_progress').DataTable().ajax.reload();
			} else if (e.target.id == 'nav-orders-completed-tab') {
				$('#tbl_completed').DataTable().ajax.reload();
			}
        })
	});

	Dropzone.autoDiscover = false;
	var dropzone = ""
	$(document).ready(function () {
		$('#duration_date').daterangepicker({
			parentEl: "duration_date",
			drops: "up"
		})

		$('form[name="promo_register_form"]').on('submit', function(e) {
			e.preventDefault()
			var validate = $('form[name="promo_register_form"]').validate({
				errorPlacement: function(error, element) {
					if( element.is(':radio') || element.is(':checkbox')) {
					} else {
						error.appendTo(element.parent().parent());
					}
				}
			})
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{ route('vendor.promo.add') }}",
				data: $('form[name="promo_register_form"]').serialize() + "&vendor_id={{ $vendor->id }}",
				type: "POST",
				success: (resp) => {
					$('#addPromo').modal('hide')
					$('#example3').DataTable().ajax.reload();
				}, 
				error: (response) => {
					var resp = response.responseJSON
					validate.showErrors(resp.errors)
				}
			})
		})

		dropzone = new Dropzone("#demo-upload", {
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			autoProcessQueue: false,
			previewTemplate: document.querySelector("#preview-template").innerHTML,
			parallelUploads: 2,
			thumbnailHeight: 120,
			thumbnailWidth: 120,
			maxFilesize: 3,
			filesizeBase: 1000,
			thumbnail: function (file, dataUrl) {
				if (file.previewElement) {
					file.previewElement.classList.remove("dz-file-preview");
					var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
					for (var i = 0; i < images.length; i++) {
						var thumbnailElement = images[i];
						thumbnailElement.alt = file.name;
						thumbnailElement.src = dataUrl;
					}
					setTimeout(function () {
						file.previewElement.classList.add("dz-image-preview");
					}, 1);
				}
			},
		});

		$('#addReal').on('show.bs.modal', function(e) {
			$("input[name='_token']").val($('meta[name="csrf-token"]').attr('content'))
		})

		$('#addReal').on("hidden.bs.modal", function(e) {
			$(this)
			.find("input,textarea,select")
				.val('')
					.end()
			.find("input[type=checkbox], input[type=radio]")
				.prop("checked", "")
					.end();
			
			dropzone.removeAllFiles(true)

		})
		

		$('form[name="create_wedding_albums"]').on('submit', function(e) {
			e.preventDefault()
			var validate = $('form[name="create_wedding_albums"]').validate()

			var formData = new FormData(this)
			$.ajax({
				url: "{{ route('vendor.add.album') }}",
				type: "POST",
				data: formData,
				processData: false,
  				contentType: false,
				success: (response) => {
					var resp = JSON.parse(response)
					$('input[name="album_id"]').val(resp)
					dropzone.processQueue();
					$('#example1').DataTable().ajax.reload();
				},
				error: (resp) => {

				}
			})
		})

		$('form[name="create_package_form"]').on("submit", function(e) {
			e.preventDefault()
			var validate = $('form[name="create_wedding_albums"]').validate()
			$.ajax({
				url: "{{ route('vendor.add.package', ['vendor_id' => $vendor->id]) }}",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: "POST",
				data: $(this).serialize(),
				success: (resp) => {
					$('#addPackage').modal('hide')
					$('#example2').DataTable().ajax.reload();
				},
				error: (resp) => {
					alert('Error: Cannot Add Package')
				}
			})
		})

		$('input[name="vendor_photo"]').change(function(e){
			var fileName = e.target.files[0].name;
			$('label[for="validateCustomeVendorPhoto"]').html(fileName)
		});

		$('input[name="vendor_banner"]').change(function(e){
			var fileName = e.target.files[0].name;
			$('label[for="validateCustomeVendorBanner"]').html(fileName)
		});

		$('form[name="form_edit_vendor"]').on("submit", (e) => {
			e.preventDefault()

			var validate = $('form[name="form_edit_vendor"]').validate({
				rules: {
					vendor_name: 'required',
					vendor_about: 'required',
					vendor_phone: 'required',
					vendor_address: 'required'
				},
				errorPlacement: function(error, element) {
					error.appendTo(element.parent().parent());
				}
			})
			
			var formData = new FormData($('form[name="form_edit_vendor"]')[0])
			$.ajax({
				type: "POST",
				url: "{{ route('vendor.edit', [ 'id' => $vendor->id ]) }}",
				data: formData,
				processData: false,
  				contentType: false,
				success: (resp) => {

					$('label[for="validateCustomeVendorPhoto"]').html("Choose File ...")
					$('label[for="validateCustomeVendorBanner"]').html("Choose File ...")
					$('input[name="vendor_photo"]').val("")
					$('input[name="vendor_banner"]').val("")

					Swal.fire({
						icon: 'success',
						title: 'Your data has been saved',
						showConfirmButton: false,
						timer: 1500
					})
				},
				error: (response) => {
					var resp = response.responseJSON
					if (typeof resp.errors === "object") {
						validate.showErrors(resp.errors)
						return true;
					}

					Swal.fire({
						title: 'Error!',
						text: 'Something goes wrong',
						icon: 'error',
					})
				}
			})
		})

		$('form[name="form_register_account_bank"]').on("submit", (e) => {
			e.preventDefault()

			var form = $('form[name="form_register_account_bank"]')
			var validate = $(form).validate({
				rules: {
					account_number: 'required',
				},
				errorPlacement: function(error, element) {
					error.appendTo(element.parent().parent());
				}
			})

			$.ajax({
				type: "POST",
				url: "{{ route('vendor.account_bank', ['vendor_id' => $vendor->id] )}}",
				data: $(form).serialize(),
				success: (resp) => {
					Swal.fire({
						icon: 'success',
						title: 'Your data has been saved',
						showConfirmButton: false,
						timer: 1500
					})
				},
				error: (response) => {
					var resp = response.responseJSON
					if (typeof resp.errors === "object") {
						validate.showErrors(resp.errors)
						return true;
					}

					Swal.fire({
						title: 'Error!',
						text: 'Something goes wrong',
						icon: 'error',
					})
				}
			})


		})
	});

	function storeWeddingAlbums() {
		$('form[name="create_wedding_albums"]').submit()
	}

	function addPhotoToAlbum(album_id) {
		var formData = new
		$.ajax({
			url: "{{ route('vendor.add.photo.album') }}",

		})
	}

	function deletePromo(idPromo) {
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				var url = "{{ route('vendor.promo.delete', ':id')}}"
				url = url.replace(":id", idPromo)
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type: "DELETE",
					url: url,
					success: (resp) => {
						swalWithBootstrapButtons.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
						)
						$('#example3').DataTable().ajax.reload();
					},
					error: (resp) => {
						swalWithBootstrapButtons.fire(
							'Ooopsss!',
							'Something goes wrong',
							'error'
						)
					}
				})
				
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
			) {
				swalWithBootstrapButtons.fire(
				'Cancelled',
				'Your imaginary file is safe :)',
				'error'
				)
			}
		})
	}

	function deletePackage(idPackage) {
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				var url = "{{ route('vendor.delete.package', ':id')}}"
				url = url.replace(":id", idPackage)
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type: "DELETE",
					url: url,
					success: (resp) => {
						swalWithBootstrapButtons.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
						)
						$('#example2').DataTable().ajax.reload();
					},
					error: (resp) => {
						swalWithBootstrapButtons.fire(
							'Ooopsss!',
							'Something goes wrong',
							'error'
						)
					}
				})
				
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
			) {
				swalWithBootstrapButtons.fire(
				'Cancelled',
				'Your imaginary file is safe :)',
				'error'
				)
			}
		})
	}

	function deleteAlbum(idAlbum) {
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				var url = "{{ route('vendor.delete.album', ':id')}}"
				url = url.replace(":id", idAlbum)
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type: "DELETE",
					url: url,
					success: (resp) => {
						swalWithBootstrapButtons.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
						)
						$('#example1').DataTable().ajax.reload();
					},
					error: (resp) => {
						swalWithBootstrapButtons.fire(
							'Ooopsss!',
							'Something goes wrong',
							'error'
						)
					}
				})
				
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
			) {
				swalWithBootstrapButtons.fire(
				'Cancelled',
				'Your imaginary file is safe :)',
				'error'
				)
			}
		})
	}

	function detailOrder(orderID) {
		$('#modal-detail-order').modal('show')
		var url = "{{ route('vendor.order.detail' , ['id' => $vendor->id, 'order_id' => ':order_id'])}}"
		url = url.replace(":order_id", orderID)

		$.ajax({
			url: url,
			type: "GET",
			success: (resp) => {
				$('#mdl-body-order').html(resp)
			}
		})
	}

	function updateOrderCompleted(orderID) {
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, confirm it!',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				var url = "{{ route('member.complete.order', ['id' => ':id'])}}"
				url = url.replace(":id", orderID)

				$.ajax({
					type: "PUT",
					url: url,
					success: () => {
						$('#tbl_progress').DataTable().ajax.reload();
					}
				})

				swalWithBootstrapButtons.fire(
					'Success!',
					'Order users has been completed',
					'success'
				)
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
			) {
				
			}
		})
	}
</script>
@endsection