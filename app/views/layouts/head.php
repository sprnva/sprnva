<?php

use App\Core\App;
use App\Core\Auth;
use App\Core\Storage;
?>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='icon' href='<?= public_url('/favicon.ico') ?>' type='image/ico' />
	<title>
		<?= ucfirst($pageTitle) . " | " . App::get('config')['app']['name'] ?>
	</title>

	<link rel="stylesheet" href="<?= public_url('/assets/sprnva/css/bootstrap.min.css') ?>">

	<style>
		@font-face {
			font-family: Nunito;
			src: url("<?= public_url('/assets/sprnva/fonts/Nunito-Regular.ttf') ?>");
		}

		body {
			font-weight: 300;
			font-family: Nunito;
			color: #26425f;
			background: #eef1f4;
		}

		.bg-light {
			background-color: #ffffff !important;
		}

		.card {
			box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
			margin-bottom: 1rem;
			border-radius: .5rem !important;
		}
	</style>

	<script src="<?= public_url('/assets/sprnva/js/jquery-3.6.0.min.js') ?>"></script>
	<script src="<?= public_url('/assets/sprnva/js/popper.min.js') ?>"></script>
	<script src="<?= public_url('/assets/sprnva/js/bootstrap.min.js') ?>"></script>

	<?php
	// this will auto include filepond css/js when adding filepond in public/assets
	if (file_exists('public/assets/filepond')) {
		require_once 'public/assets/filepond/filepond.php';
	}
	?>

	<script>
		const base_url = "<?= App::get('base_url') ?>";
	</script>
</head>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom: 1px solid #eee;">
		<div class="container">
			<a class="navbar-brand" href="<?= route('/') ?>">
				<img src="<?= public_url('/storage/images/sprnva-logo.png') ?>" alt="sprnva-logo" style="width: 40px; height: 40px;">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?= route('/home') ?>">Home</a>
					</li>
				</ul>

				<ul class="navbar-nav flex-row ml-md-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img src="<?= Storage::getAvatar(Auth::user('id')); ?>" alt="sprnva-logo" style="width: 30px; height: 30px;object-fit: cover;border-radius: 50%;">
							<?= Auth::user('fullname') ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="<?= route('/profile') ?>">Profile</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= route('/logout') ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

							<form id="logout-form" action="<?= route('/logout') ?>" method="POST" style="display:none;">
								<?= csrf() ?>
							</form>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 0 2px 5px 0 rgb(0 0 0 / 10%);">
		<div class="container">
			<div class="navbar-nav">
				<div class="nav-item">
					<div class="nav-link active" style="font-size: 18px;font-weight: 500;"><?= ucfirst($pageTitle); ?></div>
				</div>
			</div>
		</div>
	</nav>
	<div class="container mt-5">