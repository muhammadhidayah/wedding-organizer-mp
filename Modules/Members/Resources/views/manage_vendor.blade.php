@extends('members::layouts.master')

@section('cssonpage')
    <link rel="stylesheet" href="/modules/members/plugins/jquery-validator/css/screen.css">
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
								<th>Link Promo To Package</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
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
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLongTitle">Add Promo</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Promo Title</label>
					<input type="title" name="title" class="form-control" placeholder="add title" />
				</div>
				<label for="exampleInputEmail1">Discount</label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">0</span>
					</div>
					<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" />
					<div class="input-group-append">
						<span class="input-group-text">100%</span>
					</div>
				</div>

				<div class="form-group">
					<label for="exampleFormControlSelect1">Link Promo to Packages</label>
					<select class="form-control" id="exampleFormControlSelect1">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success" data-dismiss="modal">
					Submit
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
						return '<button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>'
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
						return '<button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>'
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
						return '<button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>'
					}
				}
            ]
		});
	});

	Dropzone.autoDiscover = false;
	var dropzone = ""
	$(document).ready(function () {
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
			var validate = $(this).validate()

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
				},
				error: (resp) => {

				}
			})
		})

		$('form[name="create_package_form"]').on("submit", function(e) {
			e.preventDefault()
			var validate = $(this).validate()
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
</script>
@endsection