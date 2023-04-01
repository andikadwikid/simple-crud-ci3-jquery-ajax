<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AdminLTE 3 | Dashboard</title>

	<?php

	use function PHPSTORM_META\type;

	$this->view('stylesheet/css') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Preloader -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
		</div>

		<!-- Navbar -->
		<?php $this->view('layouts/navbar') ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->view('layouts/sidebar') ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Data Employee</h1>
						</div><!-- /.col -->

						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Data Employee</li>
							</ol>
						</div><!-- /.col -->
					</div>
					<div class="row mb-2">
						<div class="col-sm-6">
							<?php if ($this->session->flashdata('error')) : ?>
								<div class="alert alert-danger">
									<?= $this->session->flashdata('error') ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>


			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<div class="card">
								<div class="card-header">
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-success" id="add-employee" data-toggle="modal" data-target="#exampleModal">
										Add Employee
									</button>
								</div>
								<div class="card-body table-responsive">
									<table class="table table-bordered">
										<!-- Load data employee -->
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="title-form"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<!-- Load form create employee -->
						</div>

					</div>
				</div>
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Footer -->
		<?php $this->view('layouts/footer') ?>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<?php $this->view('js/scripts') ?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		$(document).ready(() => {
			$.ajax({
				url: "http://localhost/test/employee/show_employee",
				type: "GET",
				cache: false,
				success: function(data) {
					$('table').append(data);
				}
			})
		});

		$(document).ready(() => {
			$('#add-employee').click(() => {
				let title = "Add new employee"
				$.ajax({
					url: "http://localhost/test/employee/create_employee",
					type: "GET",
					cache: false,
					success: function(data) {
						$('#myModal').modal('show')
						$('.modal-body').html(data);
						document.getElementById('title-form').innerHTML = title;
					}
				})

			})
		})
	</script>
</body>

</html>