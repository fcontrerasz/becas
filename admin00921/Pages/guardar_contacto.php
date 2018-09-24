<?php include("../conexion/conecta.php"); ?>
<?php

if(!$_GET){
	echo "-2";
	die;
}

if($_SESSION["idusuario"] == null){
	echo "-3";
}

echo "1";
?>