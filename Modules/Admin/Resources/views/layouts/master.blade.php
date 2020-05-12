<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 3 | Dashboard</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="/modules/admin/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="/modules/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="/modules/admin/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="/modules/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="/modules/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	@yield('cssonpage')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<!-- Navbar -->
		@include('admin::layouts.navbar')
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		@include('admin::layouts.sidebar')

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
		@yield('content')
		</div>
	</div>
	<!-- ./wrapper -->
	<!-- jQuery -->
	<script src="/modules/admin/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="/modules/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="/modules/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="/modules/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- SweetAlert2 -->
	<script src="/modules/admin/plugins/sweetalert2/sweetalert2.min.js"></script>
	<!-- jquery-validation -->
	<script src="/modules/admin/plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="/modules/admin/plugins/jquery-validation/additional-methods.min.js"></script>
	<!-- AdminLTE App -->
	<script src="/modules/admin/js/adminlte.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="/modules/admin/js/demo.js"></script>

	@yield('jsonpage')
</body>
</html>