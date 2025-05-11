<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "latihan_login_db";

$conn = mysql_connect($host, $user, $pass, $db);


if (!$conn){
    die("Koneksi gagal : " . mysql_connect_error());
}

?>