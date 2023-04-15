<?php
include_once 'includes/config.php';
$sql = "DELETE FROM `khachhang` WHERE makh='" . $_GET["makh"] . "'";
if (mysqli_query($con, $sql)) {
    // echo "Record deleted successfully";
    header("Location: cus-manage.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($con);
