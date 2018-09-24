<?php include("../conexion/conecta.php"); ?>
<?php
if(!isset($_SESSION)){
session_start();
}


if(!$_GET){
	echo "-2";
	die;
}

if($_SESSION["idusuario"] == null){
	echo "-3";
	die;
}

$variables = explode("?", $_SERVER['REQUEST_URI']);
parse_str($variables[1]);
$arr = get_defined_vars();

//var_dump($arr);

$resultado = 0;

$query = @"INSERT INTO `becascodelco`.`BITACORAS` (`IDBITACORA`, `IDACCION`, `IDPOSTULACION`, `GLOSA_BITACORA`, `IDUSUARIO`, FECHA_BITACORA) VALUES (NULL, '1', '".$i."', '".date("Y-m-d H:i:s")." CAMBIO DE ESTADO', '".$_SESSION["idusuario"]."', NOW())";
//echo $query;
$result = $db->query($query);
//or die(mysqli_error($db));
if($result){  
	$resultado = 1;
}
$db->next_result();

$query = "UPDATE POSTULACIONES_WEB SET IDESTADOBECA = ".$e." WHERE IDPOSTULACION = ".$i;
//echo $query;
$result = $db->query($query);
//or die(mysqli_error($db));
if($result){  
	$resultado += 1;
}
$db->next_result();


$db->close();
echo $resultado;
?>