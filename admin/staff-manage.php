<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	include("includes/head.php");
}
?>

<!-- Thêm nhân viên -->
<?php
if (isset($_POST['submit'])) {
	if (isset($_POST["hodem"])) {
		$hodem = $_POST['hodem'];
	}
	if (isset($_POST["ten"])) {
		$ten = $_POST['ten'];
	}
	if (isset($_POST["gioitinh"])) {
		$gioitinh = $_POST['gioitinh'];
	}
	if (isset($_POST["ngaysinh"])) {
		$ngaysinh = $_POST['ngaysinh'];
	}
	if (isset($_POST["dienthoai"])) {
		$dienthoai = $_POST['dienthoai'];
	}
	if (isset($_POST["chucdanh"])) {
		$chucdanh = $_POST['chucdanh'];
	}
	if (isset($_POST["email"])) {
		$email = $_POST['email'];
	}
	if (isset($_POST["diachi"])) {
		$diachi = $_POST['diachi'];
	}
	if (isset($_POST["matkhau"])) {
		$matkhau = $_POST['matkhau'];
	}
	$add_sql = "INSERT INTO `nhanvien` (hodem, ten, gioitinh, ngaysinh, dienthoai, chucdanh, email, diachi, matkhau) VALUES ('$hodem', '$ten', $gioitinh, '$ngaysinh', '$dienthoai', '$chucdanh', '$email', '$diachi', '$matkhau')";
	if ($result = mysqli_query($con, $add_sql)) {
		header("Location: staff-manage.php");
	} else {
		echo "Error";
	}
}

$rowsPerPage = 10; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['page'])) {
	$_GET['page'] = 1;
}
$search = $_GET['search'];
$searchValue = $_GET['searchValue'];
if (isset($search) && isset($searchValue) && !empty($searchValue)) {
	$sql = "SELECT * FROM nhanvien WHERE hodem LIKE '%$searchValue%' OR ten LIKE '%$searchValue%' OR dienthoai LIKE '%$searchValue%' OR diachi LIKE '%$searchValue%'";
	$res = mysqli_query($con, $sql);
}
else{
$offset = ($_GET['page'] - 1) * $rowsPerPage;
$sql = "SELECT * FROM nhanvien LIMIT $offset, $rowsPerPage";
$res = mysqli_query($con, $sql);
}
?>

<head>
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js">
	<style !important>
		.container-fluid {
			padding: 0;
			margin-left: 27px;
		}

		h2 {
			/* padding: 20px; */
			font-size: 22px;
			font-weight: 400;
		}

		.row {
			margin-top: 20px;
			margin-right: 20px;
		}

		.btn-success {
			background-color: #3d5af1 !important;
			border: 1px solid #3d5af1 !important;
		}

		button:focus {
			outline: none;
		}

		table,
		th,
		td {
			border: 1px solid #ccc;
		}

		table {
			border-collapse: collapse;
		}

		th {
			background-color: #3d5af1;
		}

		td {
			justify-content: center;
		}

		.table-colored-bordered.table-bordered-primary {
			border: 2px solid #3d5af1;
		}

		tr:hover {
			background-color: #ddd;
			/* cursor:pointer; */
		}

		.a-icon {
			padding: 5px;
		}

		.button {
			padding: 5px 10px;
			border-radius: 5px;
			/* background-color: #3d5af1 !important; */
			/* border: 1px solid #3d5af1 !important; */
		}

		.button.btn-add:hover {
			background-color: #198754 !important;
		}

		.modal-title {
			font-size: 20px;
		}
	</style>
</head>

<body class="fixed-left">
	<!-- Left Sidebar Start -->
	<?php include('includes/sidebarmenu.php'); ?>
	<!-- Left Sidebar End -->

	<div class="content">
		<?php
		include("includes/topheader.php");
		?>
		<div class="header-main">
			<ol class="breadcrumb p-0 m-0">
				<li><a class="nav-link">Vinpearl</a></li>
				<li><a class="nav-link">Admin</a></li>
				<li class="active">Nhân viên</li>
			</ol>
			<a class="nav-link" style="cursor: pointer;">
				<i class='bx bxs-hourglass'></i>
				Ngày truy cập: <span style="margin-left: 5px;" id="ngay"></span>
			</a>
		</div>

		<div class="container-fluid">
			<div class="row">
				<h2>Danh sách nhân viên</h2>
			</div>
			<div class="row">
				<div class="m-b-30 col-3">
					<button type="button" class="button btn-success" data-toggle="modal" data-target="#myModal">Thêm mới
						<i class="mdi mdi-plus-circle-outline"></i>
					</button>
				</div>
				<div class="col-6" style="justify-content: space-between;">
					<form action="" method="get" class="d-flex">
						<input type="text" class="form-control" name='searchValue'  placeholder="Nhập từ khóa cần tìm" style="width: 300px;" value="<?php if (isset($searchValue)) {echo $searchValue;} ?>">
						<input type="submit" class="button btn-success" name="search" value='Tìm kiếm' style="display: flex; cursor: pointer;">
					</form>
				</div>
			</div>
			<div class="row">
				<div class="table-responsive">
					<table class="table table-colored-bordered table-bordered-primary">
						<thead>
							<tr>
								<th style="	width: 30px; text-align: center;">STT</th>
								<th style="	width: 150px;">Mã nhân viên</th>
								<th style="	width: 400px;">Họ tên</th>
								<th style="	width: 100px;">Giới tính</th>
								<th>Số điện thoại</th>
								<th>Chức danh</th>
								<th>Thao tác</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// $sql = "SELECT * FROM nhanvien ";
							// $result = mysqli_query($con, $sql);
							$row = mysqli_num_rows($result);
							$i = 1;
							while ($row = mysqli_fetch_array($res)) {
							?>
								<tr>
									<td style="text-align: center;"><?php echo $i++; ?></td>
									<td><?php echo $row['manv'] ?></td>
									<td><?php echo $row['hodem'] . " " . $row['ten'] ?></td>
									<td>
										<?php
										if ($row['gioitinh'] == 1) {
											echo "Nam";
										} else {
											echo "Nữ";
										}
										?>
									</td>
									<td><?php echo $row['dienthoai'] ?></td>
									<td>
										<?php
										if ($row['chucdanh'] == 'admin') {
											echo 'Quản lý';
										} elseif ($row['chucdanh'] == 'staff') {
											echo 'Nhân viên';
										}
										?>
									</td>
									<td>
										<a href="staff-edit.php?id=<?php echo $row['manv']; ?>" class="button btn-primary" name="edit" id="edit"><i class="fa-solid fa-pen-to-square"></i></a>
										<a onclick="return confirm('Bạn có chắc chắn muốn xoá không');" href="staff-delete.php?manv=<?php echo $row['manv']; ?>" class="button btn-danger" name="delete" type="submit" id="delete"><i class="fa-solid fa-trash"></i></a>
									</td>
								</tr>
							<?php }  ?>
						</tbody>
					</table>
				</div>
				<?php
				echo "<p align='center'>";
				$re = mysqli_query($con, 'SELECT COUNT(*) as count FROM nhanvien');
				$row = mysqli_fetch_assoc($re);
				$numRows = $row['count'];
				//tổng số trang
				$maxPage = ceil($numRows / $rowsPerPage);
				//gắn thêm nút Back
				if ($_GET['page'] > 1) {
					echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=1'>&#60&#60</a> ";
					echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] - 1) . "'>&#60</a> ";
				}
				for ($i = 1; $i <= $maxPage; $i++) //tạo link tương ứng tới các trang
				{
					if ($i == $_GET['page'])
						echo "<b style='padding:0 10px;'>" . $i . "</b> "; //trang hiện tại sẽ được bôi đậm
					else
						echo "<a href='"
							. $_SERVER['PHP_SELF'] . "?page=" . $i . "'>" . $i . "</a> ";
				}
				//gắn thêm nút Next
				if ($_GET['page'] < $maxPage) {
					echo "<a href = '" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] + 1) . "'>&#62</a>";
					echo "<a href = '" . $_SERVER['PHP_SELF'] . "?page=" . $maxPage . "'>&#62&#62</a>";
				}
				echo "</p>";
				echo "<p align='center'>Tổng số trang là: $maxPage </p>";
				?>
			</div>
		</div>
	</div>
	<!-- The Modal 1 -->
	<div class="modal" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Thêm nhân viên</h4>
				</div>
				<!-- Modal body -->
				<div class="modal-body">

					<form action="" method="post">
						<div class="form-group">
							<label for="hodem">Họ đệm</label>
							<input type="text" name="hodem" id="hodem" class="form-control">
						</div>
						<br>
						<div class="form-group">
							<label for="ten">Tên</label>
							<input type="text" id="ten" name="ten" class="form-control">
						</div>
						<br>
						<div class="form-group">
							<label for="gioitinh">Giới tính</label> <br>
							<select name="gioitinh" id="gioitinh">
								<option value="1">Nam</option>
								<option value="0">Nữ</option>
							</select>
						</div>
						<br>
						<div class="form-group">
							<label for="dienthoai">Ngày sinh</label>
							<input type="date" id="ngaysinh" name="ngaysinh" class="form-control">
						</div>
						<br>
						<div class="form-group">
							<label for="dienthoai">Số điện thoại</label>
							<input type="text" id="dienthoai" name="dienthoai" class="form-control">
						</div>
						<br>
						<div class="form-group">
							<label for="chucdanh">Loại quyền</label>
							<select name="chucdanh" id="chucdanh">
								<option value="admin">Quản lý</option>
								<option value="staff">Nhân viên</option>
							</select>
						</div>
						<br>
						<div class="form-group">
							<label for="diachi">Địa chỉ</label>
							<input type="text" id="diachi" name="diachi" class="form-control">
						</div>
						<br>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" id="email" name="email" class="form-control">
						</div>
						<br>
						<div class="form-group">
							<label for="matkhau">Mật khẩu</label>
							<input type="text" id="matkhau" name="matkhau" class="form-control">
						</div>
						<br>
						<input type="submit" name="submit" value="Thêm" class="button btn-primary">
						<button type="button" class="button btn-danger" data-dismiss="modal">Huỷ</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include("includes/footer.php"); ?>

</body>