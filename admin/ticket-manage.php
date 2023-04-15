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
// $sql = "SELECT * FROM loaive";
$sql = "SELECT loaive.malv, loaive.tenloaive, loaive.mota, dichvu.loaidv, loaive.giatien
FROM dichvu
INNER JOIN loaive ON dichvu.madv = loaive.madv";
$res = mysqli_query($con, $sql);
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
      width: 90%;
    }

    tr:holoailoaiver {
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

    .button.btn-add:holoailoaiver {
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
        <li class="active">Quản lý vé</li>
      </ol>
      <a class="nav-link" style="cursor: pointer;">
        <i class='bx bxs-hourglass'></i>
        Ngày truy cập: <span style="margin-left: 5px;" id="ngay"></span>
      </a>
    </div>

    <div class="container-fluid">
      <div class="row">
        <h2>Loại vé</h2>
      </div>
      <div class="row">
        <div class="m-b-30">
          <a href="booking.php" type="button" class="button btn-success">Đặt vé</a>
        </div>
      </div>
      <div class="row">
        <div class="table-responsive">
          <table class="table table-colored-bordered table-bordered-primary">
            <thead>
              <tr>
                <th style="	width: 30px; text-align: center;">STT</th>
                <th style="	width: 150px;">Mã loại vé</th>
                <th style="	width: 200px;">Tên loại vé</th>
                <th style="	width: 180px;">Mô tả loại vé</th>
                <th style="	width: 300px;">Loại dịch vụ</th>
                <th style="	width: 150px; text-align: right;">Giá mặc định</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $giatien_arr = array(); // Khởi tạo một mảng để lưu giá tiền
              // $sql = "SELECT * FROM loailoaive ";
              // $result = mysqli_query($con, $sql);
              $row = mysqli_num_rows($result);
              $i = 1;
              while ($row = mysqli_fetch_array($res)) {
                array_push($giatien_arr, $row['giatien']); // Lưu giá tiền vào mảng
              ?>
                <tr>
                  <td style="text-align: center;"><?php echo $i++; ?></td>
                  <td><?php echo $row['malv'] ?></td>
                  <td><?php echo $row['tenloaive'] ?></td>
                  <td><?php echo $row['mota'] ?></td>
                  <td><?php echo $row['loaidv'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row['giatien']) ?> VND</td>
                  <td>
                    <a href="ticket-edit.php?id=<?php echo $row['malv']; ?>" class="button btn-primary" name="edit" id="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a onclick="return confirm('Bạn có chắc chắn muốn xoá không');" href="ticket-delete.php?mave=<?php echo $row['mave']; ?>" class="button btn-danger" name="delete" type="submit" id="delete"><i class="fa-solid fa-trash"></i></a>
                  </td>
                </tr>
              <?php }
              $_SESSION['giatien_arr'] = $giatien_arr; // lưu giá trị của mảng vào session
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include("includes/footer.php"); ?>
</body>