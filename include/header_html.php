<!DOCTYPE html>
<html lang="en">

<head>
	<title>3º B</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="/public_html/css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="/public_html/css/animate.css">
	
	<link rel="stylesheet" href="/public_html/css/owl.carousel.min.css">
	<link rel="stylesheet" href="/public_html/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="/public_html/css/magnific-popup.css">

	<link rel="stylesheet" href="/public_html/css/aos.css">

	<link rel="stylesheet" href="/public_html/css/ionicons.min.css">
	<style>
		* {
			scroll-behavior: smooth;
		}

		.sticky {
			position: sticky;
			top: 0;
			right: 0;
			left: 0;
			z-index: 1030;
		}
	</style>
	<link rel="stylesheet" href="/public_html/css/flaticon.css">
	<link rel="stylesheet" href="/public_html/css/icomoon.css">
	<link rel="stylesheet" href="/public_html/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
	<div class="bg-top navbar-light">
		<div class="container">
			<div class="row no-gutters d-flex align-items-center align-items-stretch">
				<div class="col-md-8  d-flex align-items-center py-4">
					<a class="navbar-brand" href="index.php"><img src="/public_html/images/logo_transparent.png" width="100px" class="mr-2" style="border-right:1px solid black;" ><b style="color:#f95858;">Informática</b>
					
					<span>E.E.Virgílio de Melo Franco</span>
				</a>
				</div>
				<div class="col-lg-4 d-block">
					<div class="row d-flex">
						<div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
							<div class="icon d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
							<div class="text">
								<span><?php echo $user['username']; ?></span>
								<span><?php echo $user['user_email']; ?></span>
							</div>

							<div class="dropdown" style="margin-left:10px;">
								<a class="btn btn-outline-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								</a>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<a class="dropdown-item" href="/public_html/user"><span class="ion-ios-person">Profile</a>
									<?php
									if ($user['user_role'] == 'admin') {
										echo "
									<a class='dropdown-item' href='/public_html/admin/'>
										<span class='ion-ios-home'> Admin Page
									</a>
									";
									}
									?>
									<a class="dropdown-item" href="<?= $_SERVER['PHP_SELF'] ?>?logout"><span class="ion-ios-power"> logout</a>

								</div>
							</div>


						</div>
					</div>

				</div>
			</div>
		</div>
	</div>