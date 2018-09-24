<?php
if(!isset($_SESSION)) {
     session_start();
}
$_SESSION['nombre'] = $_GET["n"];
$_SESSION['rut'] = $_GET["r"];
$_SESSION['dv'] = $_GET["d"];
$_SESSION['fono'] = $_GET["f"];
$_SESSION['email'] = $_GET["e"];
echo "1";
?>