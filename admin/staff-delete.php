<?php
include_once 'includes/config.php';
$sql = "DELETE FROM `nhanvien` WHERE manv='" . $_GET["manv"] . "'";
if (mysqli_query($con, $sql)) {
    // echo "Record deleted successfully";
    header("Location: staff-manage.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($con);
