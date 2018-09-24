<?php require_once('functions.php'); ?>
<?php

if (!isset($_SESSION)) {
  session_start();
}

error_reporting(0);
ini_set('display_errors', 0);

ini_set('default_socket_timeout',   1);
ini_set('mysql.connect_timeout',    30);
ini_set('default_socket_timeout',   30);

$hostname_cn_becas = "localhost";
$database_cn_becas = "becascodelcovp2017";
//$username_cn_becas = "root";
//$password_cn_becas = "00emdbd2011";
$username_cn_becas = "root";
$password_cn_becas = "00emdbd2015";

$db = new mysqli($hostname_cn_becas,$username_cn_becas,$password_cn_becas,$database_cn_becas);

if(mysqli_connect_errno()){
 echo mysqli_connect_error();
}

mysqli_set_charset($db,"utf8");

?>