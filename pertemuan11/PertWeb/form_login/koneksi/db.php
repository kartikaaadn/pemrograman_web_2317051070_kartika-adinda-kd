<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "latihan_login_db";

$conn = mysqli_connect($host, $user, $pass, $db);


if (!$com){
    die("Koneksi gagal : " . mysql_connect_error());
}

?>