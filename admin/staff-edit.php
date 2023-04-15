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

<?php
if (isset($_POST['submit'])) {
  $hodem = $_POST['hodem'];
  $ten = $_POST['ten'];
  $gioitinh = $_POST['gioitinh'];
  $ngaysinh = $_POST['ngaysinh'];
  $dienthoai = $_POST['dienthoai'];
  $chucdanh = $_POST['chucdanh'];
  $email = $_POST['email'];
  $diachi = $_POST['diachi'];
  $matkhau = $_POST['matkhau'];

  if (isset($hodem) && isset($ten) && isset($gioitinh) && isset($ngaysinh) && isset($dienthoai) && isset($chucdanh) && isset($email) && isset($diachi) && isset($matkhau)) {
    $query = mysqli_query($con, "UPDATE nhanvien SET hodem='$hodem',ten='$ten',gioitinh=$gioitinh,ngaysinh='$ngaysinh',dienthoai='$dienthoai',chucdanh='$chucdanh',email='$email',diachi='$diachi',matkhau='$matkhau' WHERE manv='" . $_GET['id'] . "'");
    header("Location: staff-manage.php");
  }
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
      margin-left: 20px;
    }

    .row {
      margin-top: 20px;
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


  <!-- ============================================================== -->
  <!-- Start right Content here -->
  <!-- ============================================================== -->


  <div class="content">
    <?php include("includes/topheader.php"); ?>
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
        <h2>Chỉnh sửa nhân viên</h2>

      </div>

      <div class="row">
        <?php
        $id = $_GET['id'];
        // $sql = "SELECT * FROM nhanvien WHERE manv = '$manv' ";
        // $result = mysqli_query($con, $sql);

        $query = mysqli_query($con, "select * from `nhanvien` where manv='$id'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <form action="" method="post">
          <div class="form-group"></div>
          <label for="hodem">Mã nhân viên</label>
          <input type="text" disabled name="manv" id="manv" class="form-control" value="<?php echo $row['manv'] ?>">
      </div>
      <br>
      <div class="form-group">
        <label for="hodem">Họ đệm</label>
        <input type="text" name="hodem" id="hodem" class="form-control" value="<?php echo $row['hodem'] ?>">
      </div>
      <br>
      <div class="form-group">
        <label for="ten">Tên</label>
        <input type="text" id="ten" name="ten" class="form-control" value="<?php echo $row['ten'] ?>">
      </div>
      <br>
      <div class="form-group">
        <label for="gioitinh">Giới tính</label> <br>
        <select name="gioitinh" id="gioitinh">
          <option value="1" <?php if ($row['gioitinh'] == 1) {
                              echo 'selected="selected"';
                            } ?>>Nam</option>
          <option value="0" <?php if ($row['gioitinh'] == 0) {
                              echo 'selected="selected"';
                            } ?>>Nữ</option>
        </select>
      </div>
      <br>
      <div class="form-group">
        <label for="dienthoai">Ngày sinh</label>
        <input type="date" id="ngaysinh" name="ngaysinh" class="form-control" value="<?php echo $row['ngaysinh'] ?>">
      </div>
      <br>
      <div class="form-group">
        <label for="dienthoai">Số điện thoại</label>
        <input type="text" id="dienthoai" name="dienthoai" class="form-control" value="<?php echo $row['dienthoai'] ?>">
      </div>
      <br>
      <div class="form-group">
        <label for="chucdanh">Chức danh</label>
        <select name="chucdanh" id="chucdanh">
          <option value="admin" <?php if ($row['chucdanh'] == "admin") {
                                  echo 'selected="selected"';
                                } ?>>Quản lý</option>
          <option value="staff" <?php if ($row['chucdanh'] == "staff") {
                                  echo 'selected="selected"';
                                } ?>>Nhân viên</option>
        </select>
      </div>
      <br>
      <div class="form-group">
        <label for="diachi">Địa chỉ</label>
        <input type="text" id="diachi" name="diachi" class="form-control" value="<?php echo $row['diachi'] ?>">
      </div>
      <br>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" class="form-control" value="<?php echo $row['email'] ?>">
      </div>
      <br>
      <div class="form-group">
        <label for="matkhau">Mật khẩu</label>
        <input type="text" id="matkhau" name="matkhau" class="form-control" value="<?php echo $row['matkhau'] ?>">
      </div>
      <br>
      <input type="submit" name="submit" value="Cập nhật" class="button btn-primary">
      <a href="staff-manage.php" type="button" class="button btn-danger">Huỷ</a>
      <?php ?>
      </form>

    </div>

  </div>
  </div>
  <!-- container -->

  <?php include("includes/footer.php"); ?>

</body>