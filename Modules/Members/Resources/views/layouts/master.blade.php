<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!-- Bootstrap CSS -->

	<link rel="stylesheet" href="/modules/members/style.css" />
	<link rel="stylesheet" href="/modules/members/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/modules/members/bootstrap-4.5.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/modules/members/css/bootstrap.min.css">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@yield('cssonpage')
	<title>Weddingku.com</title>
</head>

<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="{{ route('member.home') }}">Weddingku.com</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<form class="form-inline my-2 my-lg-0 mr-auto ml-3">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="search" />
			</form>
			@if (Auth::check())
			<div class="dropdown ml-auto">
				@if (Auth::user()->user_photo != "")
				<img class="user rounded-circle" src="/modules/members/img/{{ Auth::user()->user_photo }}" alt="user" />
				@else
				<img class="user rounded-circle" src="/modules/members/img/user.jpg" alt="user" />
				@endif

				||
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					{{ Auth::user()->name }}
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="#">MY PROFILE</a>
					<a class="dropdown-item" href="{{ route('members.create.vendor') }}">MANAGE VENDOR</a>
					
					<a class="dropdown-item" href="#">SETTINGS</a>
					<a class="dropdown-item" href="#">SIGN OUT</a>
				</div>

			</div>
			@else
			<!-- Button trigger modal -->
			<button type="button" class="btn login" data-toggle="modal" data-backdrop="static" data-keyboard="false"
				data-target="#loginModal">
				<h6>LOGIN</h4>
			</button>
			@endif

		</div>
	</nav>

	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h3 class="modal-title" id="exampleModalLongTitle">Sign In</h3>
				</div>
				<form action="{{ route('members.login') }}" name="form_login">
					@csrf
					<div class="modal-body">
						<div class="form-group">
							<input type="text" name="username" class="form-control" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
						<div class="text-right">
							<!-- <span><a href="#">Forgot Password?</a></span> -->

							<!-- Button trigger modal -->
							<button type="button" class="btn login" data-toggle="modal" data-backdrop="static" data-keyboard="false"
								data-target="#forgotModal">
								<a href="#" id="linkForgot">Forget Password</a>
							</button>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" onclick="authenticationUser();" class="btn btn-success btn-block">SIGN IN</button>
					</div>
				</form>
				<div class="form-group text-center mt-2">
					<span>Don't have an account? <a href="#">SIGN UP NOW</a></span>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Forgot Password -->
	<div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h3 class="modal-title" id="exampleModalLongTitle">Recover Password</h3>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button> -->
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Your email or mobile phone</label>
						<input type="text" name="username" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-block" id="btnRecover" data-dismiss="modal">email me a
						recovery link</button>
				</div>
			</div>
		</div>
	</div>

	@yield('content')

	<section>
		<div class="jumbotron about">
			<div class="row">
				<div class="col-md-6">
					<h4>Weddingku</h4>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo quaerat eveniet esse cum, a
						repellat officia quos modi magnam neque ad harum, quidem similique nisi quam consequuntur,
						repellendus amet provident?</p><br>
					<h4 class="mb-2" id="logoFollow">FOLLOW US</h4>
					<a href="">
						<i class="fa fa-facebook-f fa-lg"></i>
					</a>
					<a href="">
						<i class="fa fa-instagram fa-lg"></i>
					</a>
					<a href="">
						<i class="fa fa-twitter fa-lg"></i>
					</a>
					<a href="">
						<i class="fa fa-youtube fa-lg"></i>
					</a>
					</ul>
				</div>
				<div class="col-md-2">

				</div>
				<div class="col-md-4 ">
					<h4>Call Us</h4>
					<p>Jl. Guntur No.18 Setia Budi Jakarta Selatan</p>
					<p>Email : weddingku@gmail.co.id</p>
					<p>Handphone : 0813492847</p>
				</div>
			</div>
		</div>
	</section>
	<footer>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<p class="text-center">
						© 2002-2020 Weddingku.com. Powered by Reza</p>
				</div>
			</div>
		</div>
	</footer>
	<script src="/modules/members/jquery-3.5.1.min.js"></script>
	<!-- <script src="./DataTables-1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="./DataTables-1.10.21/js/dataTables.bootstrap4.js"></script>
	<script src="./dropzone/dist/dropzone.js"></script> -->
	<script src="/modules/members/js/bootstrap.js"></script>
	<script src="/modules/members/script.js"></script>
	<script>
		$(function() {
			@if (Auth::check() === FALSE)
				$('#loginModal').modal({
					backdrop: 'static',
					keyboard: false
				});
			@endif

			$.ajax({
				type: "GET",
				url: "{{ route('member.check.vendor', ['user_id' => Auth::id()]) }}",
				success: (resp) => {
					if(resp) {
						document.querySelector("#navbarSupportedContent > div > div > a:nth-child(2)").setAttribute('href', "{{ route('members.manage.vendor') }}")
						
					}
				}
			})
		})

		function authenticationUser() {
			var formData = $('form[name="form_login"]')
			$.ajax({
				type: "POST",
				url: formData.attr('action'),
				data: formData.serialize(),
				success: (resp) => {
					$('#loginModal').modal('hide')
					location.reload()
				}
			})
		}
	</script>
	@yield('jsonpage')
</body>

</html>