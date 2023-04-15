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
$sql = "SELECT loaive.malv, loaive.tenloaive, loaive.mota, dichvu.loaidv, loaive.giatien
FROM dichvu
INNER JOIN loaive ON dichvu.madv = loaive.madv";

if (isset($_POST['submit'])) {


  if (isset($hodem) && isset($ten) && isset($gioitinh) && isset($ngaysinh) && isset($dienthoai) && isset($email) && isset($diachi) && isset($matkhau)) {
    $query = mysqli_query($con, "UPDATE khachhang SET hodem='$hodem',ten='$ten',gioitinh=$gioitinh,ngaysinh='$ngaysinh',dienthoai='$dienthoai',email='$email',diachi='$diachi',matkhau='$matkhau' WHERE makh='" . $_GET['id'] . "'");
    header("Location: cus-manage.php");
  }
}
?>

<head>
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style !important>
    .container-fluid {
      padding: 0;
      margin-left: 27px;
    }

    h2 {
      /* padding: 20px; */
      font-size: 22px;
      font-weight: 400;
      margin-left: 2px;
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
  <?php include('includes/sidebarmenu.php'); ?>

  <div class="content">
    <?php include("includes/topheader.php"); ?>
    <div class="header-main">
      <ol class="breadcrumb p-0 m-0">
        <li><a class="nav-link">Vinpearl</a></li>
        <li><a class="nav-link">Admin</a></li>
        <li class="active">Chỉnh sửa loại vé</li>
      </ol>
      <a class="nav-link" style="cursor: pointer;">
        <i class='bx bxs-hourglass'></i>
        Ngày truy cập: <span style="margin-left: 5px;" id="ngay"></span>
      </a>
    </div>

    <div class="container-fluid">
      <div class="row">
        <h2>Chỉnh sửa loại vé</h2>

      </div>

      <div class="row">
        <?php
        $id = $_GET['id'];
        // $sql = "SELECT * FROM khachhang WHERE makh = '$makh' ";
        // $result = mysqli_query($con, $sql);

        $query = mysqli_query($con, "select * from `loaive` where malv='$id'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <form action="" method="post">
          <div class="form-group" style="width:200px;">
            <label for="malv">Mã loại vé</label>
            <input type="text" disabled name="malv" id="malv" class="form-control" value="<?php echo $row['malv'] ?>">
          </div>
          <br>
          <div class="form-group" style="width:200px;">
            <label for="giatien">Giá vé</label>
            <input type="text" name="giatien" id="giatien" class="form-control" value="<?php echo number_format($row['giatien'])  ?>">
          </div>
          <br>
          <input type="submit" name="submit" value="Cập nhật" class="button btn-success">
          <a href="ticket-manage.php" type="button" class="button btn-danger">Huỷ</a>
        </form>
      </div>
    </div>
  </div>


  <?php include("includes/footer.php"); ?>
</body>