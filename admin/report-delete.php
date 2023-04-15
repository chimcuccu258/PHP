<?php
include_once 'includes/config.php';
$sql = "DELETE FROM `hoadon` WHERE mahd='" . $_GET["mahd"] . "'";
if (mysqli_query($con, $sql)) {
    // echo "Record deleted successfully";
    header("Location: report.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($con);
