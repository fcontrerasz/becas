<?php
session_start();
$_SESSION["nombre"] = null;
$_SESSION["usuario"] = null;
$_SESSION["idusuario"] = null;
session_destroy();
header("Location: ../login.php");
?>