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


  <!-- ============================================================== -->
  <!-- Start right Content here -->
  <!-- ============================================================== -->


  <div class="content">
    <?php include("includes/topheader.php"); ?>
    <div class="header-main">
      <ol class="breadcrumb p-0 m-0">
        <li><a class="nav-link">Vinpearl</a></li>
        <li><a class="nav-link">Admin</a></li>
        <li class="active">Cài đặt</li>
      </ol>
      <a class="nav-link" style="cursor: pointer;">
        <i class='bx bxs-hourglass'></i>
        Ngày truy cập: <span style="margin-left: 5px;" id="ngay"></span>
      </a>
    </div>

    <div class="container-fluid">




    </div>
    <!-- container -->

    <?php include("includes/footer.php"); ?>

</body>