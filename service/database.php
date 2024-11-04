<?php 

$hostname = "localhost";
$username = "root";
$password ="";
$database_name = "database_login";

//untuk memakai database
$db = mysqli_connect($hostname, $username,   $password , $database_name);

if($db->connect_error){
    echo "koneksi database rusak";
    die("error!!!");
}
