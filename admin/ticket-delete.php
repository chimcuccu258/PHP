<?php
include_once 'includes/config.php';
$sql = "DELETE FROM `loaive` WHERE mave='" . $_GET["mave"] . "'";
if (mysqli_query($con, $sql)) {
  // echo "Record deleted successfully";
  header("Location: ticket-manage.php");
} else {
  echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($con);
