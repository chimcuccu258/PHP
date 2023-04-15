<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	include("includes/head.php");
?>

	<?php
	$sum_sql = "SELECT COUNT(*) FROM nhanvien";
	$sum_res = mysqli_query($con, $sum_sql);
	$cus_sql = "SELECT COUNT(*) FROM khachhang";
	$cus_res = mysqli_query($con, $cus_sql);
	$ser_sql = "SELECT COUNT(*) FROM dichvu";
	$ser_res = mysqli_query($con, $ser_sql);
	// $tic_sql = "SELECT COUNT(*) FROM loaive";
	// $tic_res = mysqli_query($con, $tic_sql);
	$tic_sql = "SELECT SUM(loaive.giatien*cthd.soluong) as tongtien 
FROM hoadon 
JOIN cthd ON hoadon.mahd = cthd.mahd
JOIN ve ON cthd.mave = ve.mave
JOIN loaive ON ve.malv = loaive.malv
JOIN dichvu ON loaive.madv = dichvu.madv";
	$tic_res = mysqli_query($con, $tic_sql);
	?>

	<head>
		<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js">
		<style !important>
			.container {
				padding: 0;
			}

			.card {
				padding: 50px;
				border-radius: 10px;
				margin: 10px;
			}

			.card-body {
				padding: 20px 0 5px 0;
			}

			h5 {
				font-size: 20px;
				font-weight: 600;
			}

			.button {
				padding: 5px 10px;
				border-radius: 5px;
				color: #fff;
				background-color: #1DAB23 !important;
				border: 1px solid #1DAB23 !important;
			}

			.button.btn-add:hover {
				background-color: #198754 !important;
			}
		</style>
	</head>

	<body class="fixed-left">

		<!-- Left Sidebar Start -->
		<?php include('includes/sidebarmenu.php'); ?>
		<!-- Left Sidebar End -->


		<div class="container">
			<?php
			include("includes/topheader.php");
			?>
			<div class="header-main">
				<ol class="breadcrumb p-0 m-0">
					<li><a class="nav-link">Vinpearl</a></li>
					<li><a class="nav-link">Admin</a></li>
					<li class="active">Trang chủ</li>
				</ol>
				<a class="nav-link" style="cursor: pointer;">
					<i class='bx bxs-hourglass'></i>
					Ngày truy cập: <span style="margin-left: 5px;" id="ngay"></span>
				</a>
			</div>
			<div class="container-fluid">
				<div class="row d-flex justify-content-around">
					<div class="card col-5">
						<img src="https://images.unsplash.com/photo-1587440871875-191322ee64b0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2971&q=80" class="card-img-top" alt="" style="width:auto; height:100px; object-fit:cover;">
						<div class="card-body">
							<h5 class="card-title">Nhân viên</h5>
							<p class="card-text">Số lượng: <?php echo mysqli_fetch_array($sum_res)[0]; ?></p>
							<br>
							<a href="staff-manage.php" class="button" style="color:#fff">Danh sách nhân viên</a>
						</div>
					</div>
					<div class="card col-5">
						<img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3132&q=80" class="card-img-top" alt="" style="width:auto; height:100px; object-fit:cover;">
						<div class="card-body">
							<h5 class="card-title">Khách hàng</h5>
							<p class="card-text">Số lượng: <?php echo mysqli_fetch_array($cus_res)[0]; ?></p>
							<br>
							<a href="cus-manage.php" class="button" style="color:#fff" !important>Danh sách khách hàng</a>
						</div>
					</div>
				</div>
				<div class="row d-flex justify-content-around">
					<div class="card col-5">
						<img src="https://images.unsplash.com/photo-1605152276897-4f618f831968?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2370&q=80" class="card-img-top" alt="" style="width:auto; height:100px; object-fit:cover;">
						<div class="card-body">
							<h5 class="card-title">Dịch vụ</h5>
							<p class="card-text">Số lượng: <?php echo mysqli_fetch_array($ser_res)[0]; ?></p>
							<br>
							<a href="service-manage.php" class="button" style="color:#fff">Danh sách dịch vụ</a>
						</div>
					</div>
					<div class="card col-5">
						<img src="https://images.unsplash.com/photo-1563802560775-445d06537a8d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2370&q=80" class="card-img-top" alt="" style="width:auto; height:100px; object-fit:cover;">
						<div class="card-body">
							<h5 class="card-title">Doanh thu bán vé</h5>
							<p class="card-text">Doanh thu: <?php echo number_format(mysqli_fetch_array($tic_res)[0]); ?> VND</p>
							<br>
							<a href="report.php" class="button" style="color:#fff" !important>Thống kê</a>
						</div>
					</div>
				</div>
			</div>
			<?php
			include("includes/footer.php");
			?>


	</body>


	</html>
<?php } ?>