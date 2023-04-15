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
$sql = "SELECT hoadon.mahd, hoadon.manv, hoadon.makh, hoadon.ngaylap, SUM(cthd.soluong) as tongve, SUM(loaive.giatien*cthd.soluong) as tongtien 
FROM hoadon 
JOIN cthd ON hoadon.mahd = cthd.mahd
JOIN ve ON cthd.mave = ve.mave
JOIN loaive ON ve.malv = loaive.malv
JOIN dichvu ON loaive.madv = dichvu.madv
GROUP BY hoadon.mahd";
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
        <li class="active">Thống kê</li>
      </ol>
      <a class="nav-link" style="cursor: pointer;">
        <i class='bx bxs-hourglass'></i>
        Ngày truy cập: <span style="margin-left: 5px;" id="ngay"></span>
      </a>
    </div>

    <div class="container-fluid">
      <div class="row">
        <h2>Thống kê</h2>
        
      </div>
      <div class="row">
        <div class="table-responsive">
          <form action="" method="post">
            <table class="table table-colored-bordered table-bordered-primary" style="text-align: center; justify-content: center;">
              <thead>
                <tr>
                  <th style="	width: 100px; text-align: center;">Mã hoá đơn</th>
                  <th style="	width: 150px; text-align: center;">Mã nhân viên</th>
                  <th style="	width: 150px; text-align: center;">Mã khách hàng</th>
                  <th style="	width: 150px; text-align: center;">Số lượng</th>
                  <th style="	width: 150px; text-align: center;">Tổng tiền</th>
                  <th style="	width: 150px; text-align: center;">Ngày lập</th>
                  <th style="	width: 150px; text-align: center;">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_array($res)) {
                ?>
                  <tr>
                    <td><?php echo $row['mahd']; ?></td>
                    <td><?php echo $row['manv']; ?></td>
                    <td><?php echo $row['makh']; ?></td>
                    <td><?php echo $row['tongve']; ?></td>
                    <td><?php echo number_format($row['tongtien']); ?> VND</td>
                    <td><?php echo date('d-m-Y', strtotime($row['ngaylap'])); ?></td>
                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xoá không');" href="report-delete.php?mahd=<?php echo $row['mahd']; ?>" class="button btn-danger" name="delete" type="submit" id="delete"><i class="fa-solid fa-trash"></i></a></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include("includes/footer.php"); ?>
</body>