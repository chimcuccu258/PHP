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
$giatien_arr = $_SESSION['giatien_arr']; // lấy giá trị của mảng từ session
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
        <li class="active">Đặt vé</li>
      </ol>
      <a class="nav-link" style="cursor: pointer;">
        <i class='bx bxs-hourglass'></i>
        Ngày truy cập: <span style="margin-left: 5px;" id="ngay"></span>
      </a>
    </div>

    <div class="container-fluid">
      <div class="row">
        <h2>Đặt vé</h2>
      </div>
      <div class="row">
        <div class="table-responsive">
          <form action="" method="get">
            <table class="table table-colored-bordered table-bordered-primary" style="text-align: center; justify-content: center;">
              <thead>
                <tr>
                  <th style="	width: 50px; text-align: center;">Loại vé</th>
                  <th style="	width: 150px; text-align: center;">VinWonders</th>
                  <th style="	width: 150px; text-align: center;">VinWonders & Vinpearl Safari</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Người lớn</td>
                  <td> <?= number_format($giatien_arr[0]). " " . "VND" ?>
                    <input type="number" class="form-control" name="quantity0" value="<?php if (isset($_GET['quantity0'])) { echo $_GET['quantity0']; } else echo 0; ?>" min="0" max="10">
                  </td>
                  <td> <?= number_format($giatien_arr[1]). " " . "VND" ?>
                    <input type="number" class="form-control" name="quantity1" value="<?php if (isset($_GET['quantity1'])) echo $_GET['quantity1'];
                                                                                      else echo 0;  ?>" min="0" max="10">
                  </td>
                </tr>
                <tr>
                  <td>Trẻ em</td>
                  <td> <?= number_format($giatien_arr[2]). " " . "VND" ?>
                    <input type="number" class="form-control" name="quantity2" value="<?php if (isset($_GET['quantity2'])) echo $_GET['quantity2'];
                                                                                      else echo 0; ?>" min="0" max="10">
                  </td>
                  <td> <?= number_format($giatien_arr[3]). " " . "VND" ?>
                    <input type="number" class="form-control" name="quantity3" value="<?php if (isset($_GET['quantity3'])) echo $_GET['quantity3'];
                                                                                      else echo 0; ?>" min="0" max="10">
                  </td>
                </tr>
                <tr>
                  <td>Người cao tuổi</td>
                  <td> <?= number_format($giatien_arr[4]). " " . "VND" ?>
                    <input type="number" class="form-control" name="quantity4" value="<?php if (isset($_GET['quantity4'])) echo $_GET['quantity4'];
                                                                                      else echo 0; ?>" min="0" max="10">
                  </td>
                  <td> <?= number_format($giatien_arr[5]). " " . "VND" ?>
                    <input type="number" class="form-control" name="quantity5" value="<?php if (isset($_GET['quantity5'])) echo $_GET['quantity5'];
                                                                                      else echo 0; ?>" min="0" max="10">
                  </td>
                </tr>
              </tbody>
            </table>
            <input type="submit" class="button btn-success" name="submit" value="Tính tiền">
          </form>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="table-responsive">
          <?php
          $sum = 0;
          if (isset($_GET['submit'])) {
            if (isset($_GET['quantity0']) && isset($_GET['quantity1']) && isset($_GET['quantity2']) && isset($_GET['quantity3']) && isset($_GET['quantity4']) && isset($_GET['quantity5'])) {
              $sum += $giatien_arr[0] * $_GET['quantity0'] + $giatien_arr[1] * $_GET['quantity1'] + $giatien_arr[2] * $_GET['quantity3'] + $giatien_arr[3] * $_GET['quantity3'] + $giatien_arr[4] * $_GET['quantity4'] + $giatien_arr[5] * $_GET['quantity5'];
              $sl = $_GET['quantity0'] + $_GET['quantity1'] + $_GET['quantity2'] + $_GET['quantity3'] + $_GET['quantity4'] + $_GET['quantity5'];
            }
          }
          ?>

          <label for="disabledTextInput">Số lượng vé</label>
          <input type="text" disabled class="form-control" value="<?php echo $sl ?>" style="width: 400px;">
          <br>
          <label for="disabledTextInput">Tổng tiền</label>
          <input type="text" disabled class="form-control" value="<?php echo number_format($sum). " " . "VND" ?>" style="width: 400px;">
          <br>
          <form action="" method="get">
            <input type="submit" class="button btn-success" name="submit1" value="Đặt vé">
            <a href="booking.php" type="button" class="button btn-danger">Huỷ</a>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include("includes/footer.php"); ?>
</body>