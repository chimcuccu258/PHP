<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME','QLVP');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

    // $severname="localhost";
    // $username="root";
    // $password="";
    // $dbname="QLVP";

    // $conn=mysqli_connect($severname,$username,$password,$dbname);

    // if (!$conn) { 
    //     die('Connect failed: '. mysqli_connect_error());
    // }
    // echo "Connected successfully";
?>