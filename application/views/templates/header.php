<?php
defined('BASEPATH') or exit('No direct script access allowed');
    $userID = $this->session->userdata('userID');
    $userRole = $this->session->userdata('userRole');

	if (isset($userID)){
		$this->user_model->checkStatus($userID);
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="SimpleIgniter is a basic user & admin system written in PHP/CodeIgniter.">
	<meta name="author" content="William Jordan Allen">

	<title><?=$title;?></title>

	<!-- Custom Styles -->
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom Scripts -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="<?= base_url('/assets/js/main.js'); ?>"></script>
</head>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				<!-- Topbar -->
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<div class="container">
						<a class="navbar-brand" href="<?= site_url(); ?>">SimpleIgniter</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle Navigation">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav mr-auto">
								<li class="nav-item">
									<a class="nav-link" href="<?= site_url(); ?>">Home</a>
								</li>
							</ul>
							<ul class="navbar-nav">
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<?php
	# If User Is Logged In
	if ($userID) {
		echo '
										'.$this->session->userdata('userFirstName').' '.$this->session->userdata('userLastName').'
									</a>
									<div class="dropdown-menu" aria-labelledby="userDropdown">
											<a class="dropdown-item" href="' . site_url('profile/edit') . '">Profile</a>
											<a class="dropdown-item" href="' . site_url('profile/logout') . '">Logout</a>
		';
	}
	# If User Is NOT Logged In
	else {
		echo '
										User
									</a>
									<div class="dropdown-menu" aria-labelledby="userDropdown">
											<a class="dropdown-item" href="' . site_url('users/login') . '">Login</a>
											<a class="dropdown-item" href="' . site_url('users/register') . '">Register</a>
		';
	}

	# If User Is Admin
	if ($this->user->isAdmin($userRole)){
		echo '
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="'.site_url('admin').'">Admin</a>
		';
	}
?>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</nav>
				<!-- End of Topbar -->

				<!-- Begin Alert Messages -->
				<div class="container" style="padding-top: 20px;">
<?php
	# Container Handling All Pop-Up Messages
	if ($this->session->flashdata('success')) {
		echo '
						<div class="alert alert-success alert-dismissible fade show">
							' . $this->session->flashdata('success') . '
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
		';
	}
	if ($this->session->flashdata('warning')) {
		echo '
						<div class="alert alert-warning alert-dismissible fade show">
							' . $this->session->flashdata('warning') . '
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
		';
	}
	if ($this->session->flashdata('danger')) {
		echo '
						<div class="alert alert-danger alert-dismissible fade show">
							' . $this->session->flashdata('danger') . '
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
		';
	}
?>
				</div>
				<!-- End Alert Messages -->

				<!-- Begin Page Content -->
				<div class="container-fluid" style="padding-top: 20px;">