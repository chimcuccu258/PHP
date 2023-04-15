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

<!-- Thêm dịch vụ -->
<?php
if (isset($_POST['submit'])) {

  if (isset($_POST["loaidv"])) {
    $loaidv = $_POST['loaidv'];
  }
  $serv_sql = "INSERT INTO `dichvu` (loaidv) VALUES ('$loaidv')";
  if ($result = mysqli_query($con, $serv_sql)) {
    header("Location: service-manage.php");
  } else {
    echo "Error";
  }
}

// Sửa dịch vụ
if (isset($_POST['submit2'])) {
  if (isset($_POST["loaidv"])) {
    $loaidv = $_POST['loaidv'];
  }
  $up_sql = "UPDATE `dichvu` SET loaidv = '$loaidv' WHERE madv = $madv";
  if ($up_res = mysqli_query($con, $up_sql)) {
    header("Location: service-manage.php");
  } else {
    echo "Error";
  }
}

$sql = "SELECT * FROM dichvu";
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
      width: 60%;
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
      /* background-color: #198754 !important; */
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
        <li class="active">Dịch vụ</li>
      </ol>
      <a class="nav-link" style="cursor: pointer;">
        <i class='bx bxs-hourglass'></i>
        Ngày truy cập: <span style="margin-left: 5px;" id="ngay"></span>
      </a>
    </div>

    <div class="container-fluid">
      <div class="row">
        <h2>Dịch vụ</h2>
      </div>
      <div class="row">
        <div class="table-responsive">
          <table class="table table-colored-bordered table-bordered-primary">
            <thead>
              <tr>
                <th style="	width: 30px; text-align: center;">STT</th>
                <th style="	width: 150px;">Mã dịch vụ</th>
                <th style="	width: 400px;">Loại dịch vụ</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // $sql = "SELECT * FROM dichvu ";
              // $result = mysqli_query($con, $sql);
              $row = mysqli_num_rows($result);
              $i = 1;
              while ($row = mysqli_fetch_array($res)) {
              ?>
                <tr>
                  <td style="text-align: center;"><?php echo $i++; ?></td>
                  <td><?php echo $row['madv'] ?></td>
                  <td><?php echo $row['loaidv'] ?></td>
                  <td>
                    <a href="service-edit.php?id=<?php echo $row['madv']; ?>" class="button btn-primary" name="edit" id="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a onclick="return confirm('Bạn có chắc chắn muốn xoá không');" href="service-delete.php?madv=<?php echo $row['madv']; ?>" class="button btn-danger" name="delete" type="submit" id="delete"><i class="fa-solid fa-trash"></i></a>
                  </td>
                </tr>
              <?php }  ?>
            </tbody>
          </table>
        </div>
        <?php
        ?>
      </div>

      <div class="row">
        <h2>Thêm dịch vụ</h2>
      </div>

      <div class="row">
        <?php
        $getMaDV = mysqli_query($con, "SELECT * FROM `dichvu` WHERE `madv` = (SELECT MAX(`madv`) FROM `dichvu`)");
        $rowDV = mysqli_fetch_assoc($getMaDV);
        ?>
        <form action="" method="post">
          <div class="form-group" style="width:60%">
            <label for="madv">Mã dịch vụ</label>
            <input type="text" disabled class="form-control" value="<?php echo $rowDV['madv'] + 1 ?>">
          </div>
          <br>
          <div class="form-group" style="width:60%">
            <label for="loaidv">Loại dịch vụ</label>
            <input type="text" class="form-control" id="loaidv" name="loaidv">
          </div>
          <br>
          <input type="submit" name="submit" value="Thêm mới" class="button btn btn-outline-success">
        </form>
      </div>

    </div>

    <?php include("includes/footer.php"); ?>

</body>