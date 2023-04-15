<?php
include_once 'includes/config.php';
$sql = "DELETE FROM `dichvu` WHERE madv='" . $_GET["madv"] . "'";
if (mysqli_query($con, $sql)) {
    // echo "Record deleted successfully";
    header("Location: service-manage.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($con);
