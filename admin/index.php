<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['login'])) {
	// Getting email and password
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = mysqli_query($con, "SELECT email,matkhau FROM nhanvien WHERE email='$email' and matkhau='$password'");
	$num = mysqli_fetch_array($sql);
	if ($num > 0) {
		$_SESSION['login'] = $_POST['email'];
		setcookie('type', 'admin', time() + (604800), "/");
		setcookie('$login', $row['email'], time() + (604800), "/");
		echo "<script type='text/javascript'> document.location = 'dashboard1.php'; </script>";
	} else {
		echo "<script>alert('Wrong Password');</script>";
	}
} else {
	// echo "<script>alert('Invalid account');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Panel</title>

	<!-- CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/core.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/components.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

	<script src="assets/js/modernizr.min.js"></script>

	<style !important>
		html {
			height: 100%;
		}

		body {
			margin: 0;
			padding: 0;
			font-family: sans-serif;
			background: rgba(0, 0, 0, 0.5) url("../images/vp1.webp") 50% fixed;
			background-size: cover;
		}

		.login-box {
			position: absolute;
			top: 50%;
			left: 50%;
			width: 400px;
			padding: 40px;
			transform: translate(-50%, -50%);
			background: rgba(0, 0, 0, .5);
			box-sizing: border-box;
			box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
			border-radius: 10px;
			text-align: center;
		}

		.login-box h2 {
			margin: 0 0 30px;
			padding: 0;
			color: #fff;
			text-align: center;
		}

		.login-box .form-group {
			position: relative;
		}

		.login-box .form-group input {
			width: 100%;
			padding: 10px 0;
			font-size: 16px;
			color: #fff;
			margin-bottom: 30px;
			border: none;
			border-bottom: 1px solid #fff;
			outline: none;
			background: transparent;
		}

		.login-box .form-group label {
			position: absolute;
			top: 0;
			left: 0;
			padding: 10px 0;
			font-size: 16px;
			color: #fff;
			pointer-events: none;
			transition: .5s;
		}

		.login-box .form-group input:focus~label,
		.login-box .form-group input:valid~label {
			top: -20px;
			left: 0;
			color: #03e9f4;
			font-size: 12px;
		}

		.login-box form button {
			position: relative;
			display: inline-block;
			padding: 10px 20px;
			color: #03e9f4;
			font-size: 16px;
			text-decoration: none;
			text-transform: uppercase;
			overflow: hidden;
			transition: .5s;
			margin-top: 40px;
			letter-spacing: 4px;
			background-color: transparent;
			border: none;
		}

		.login-box button:hover {
			background: #03e9f4;
			color: #fff;
			border-radius: 5px;
			box-shadow: 0 0 5px #03e9f4,
				0 0 25px #03e9f4,
				0 0 50px #03e9f4,
				0 0 100px #03e9f4;
		}

		.login-box button span {
			position: absolute;
			display: block;
		}

		.login-box button span:nth-child(1) {
			top: 0;
			left: -100%;
			width: 100%;
			height: 2px;
			background: linear-gradient(90deg, transparent, #03e9f4);
			animation: btn-anim1 1s linear infinite;
		}

		@keyframes btn-anim1 {
			0% {
				left: -100%;
			}

			50%,
			100% {
				left: 100%;
			}
		}

		.login-box button span:nth-child(2) {
			top: -100%;
			right: 0;
			width: 2px;
			height: 100%;
			background: linear-gradient(180deg, transparent, #03e9f4);
			animation: btn-anim2 1s linear infinite;
			animation-delay: .25s
		}

		@keyframes btn-anim2 {
			0% {
				top: -100%;
			}

			50%,
			100% {
				top: 100%;
			}
		}

		.login-box button span:nth-child(3) {
			bottom: 0;
			right: -100%;
			width: 100%;
			height: 2px;
			background: linear-gradient(270deg, transparent, #03e9f4);
			animation: btn-anim3 1s linear infinite;
			animation-delay: .5s
		}

		@keyframes btn-anim3 {
			0% {
				right: -100%;
			}

			50%,
			100% {
				right: 100%;
			}
		}

		.login-box button span:nth-child(4) {
			bottom: -100%;
			left: 0;
			width: 2px;
			height: 100%;
			background: linear-gradient(360deg, transparent, #03e9f4);
			animation: btn-anim4 1s linear infinite;
			animation-delay: .75s
		}

		@keyframes btn-anim4 {
			0% {
				bottom: -100%;
			}

			50%,
			100% {
				bottom: 100%;
			}
		}
	</style>
</head>


<body>
	<!-- HOME -->
	<section>
		<div class="container-fluid">
			<div class="row">
				<div class="login-box">
					<h2>ADMIN PANEL</h2>
					<form method="post">
						<div class="form-group">
							<label></label>
							<input type="text" class="form-control" placeholder="Enter Email" name="email" value="" required>
						</div>
						<div class="form-group">
							<label></label>
							<input type="password" class="form-control" placeholder="Enter Password" name="password" value="" required>
						</div>
						<button type="submit" name="login" class="btn btn-dark">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							Đăng nhập
						</button>
					</form>
				</div>
			</div>

		</div>
	</section>
	<!-- END HOME -->

	<script>
		var resizefunc = [];
	</script>

	<!-- jQuery  -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/detect.js"></script>
	<script src="assets/js/fastclick.js"></script>
	<script src="assets/js/jquery.blockUI.js"></script>
	<script src="assets/js/waves.js"></script>
	<script src="assets/js/jquery.slimscroll.js"></script>
	<script src="assets/js/jquery.scrollTo.min.js"></script>

	<!-- App js -->
	<script src="assets/js/jquery.core.js"></script>
	<script src="assets/js/jquery.app.js"></script>

</body>

</html>