<?php include("../conexion/conecta.php"); ?>
<?php

function limpiar($s)
{
$s = preg_replace("/[áàâãª]/","a",$s);
$s = preg_replace("/[ÁÀÂÃ]/","A",$s);
$s = preg_replace("/[ÍÌÎ]/","I",$s);
$s = preg_replace("/[íìî]/","i",$s);
$s = preg_replace("/[éèê]/","e",$s);
$s = preg_replace("/[ÉÈÊ]/","E",$s);
$s = preg_replace("/[óòôõº]/","o",$s);
$s = preg_replace("/[ÓÒÔÕ]/","O",$s);
$s = preg_replace("/[úùû]/","u",$s);
$s = preg_replace("/[ÚÙÛ]/","U",$s);
$s = str_replace("ç","c",$s);
$s = ereg_replace("Ç","C",$s);
$s = ereg_replace("ñ","n",$s);
$s = ereg_replace("Ñ","N",$s);
$str = ereg_replace ("ö","o", $str );

return $s;
}

session_start();

if(!$_GET){
	echo "-2";
	die;
}

if($_SESSION["idusuario"] == null){
	echo "-3";
}

$usr = $_SESSION["idusuario"];
$nombre = limpiar(utf8_decode($_GET["nu_nombre"]));
$materno = limpiar(utf8_decode($_GET["nu_apellidom"]));
$paterno = limpiar(utf8_decode($_GET["nu_apellidop"]));
$fono = $_GET["nu_fono"];
$rut = $_GET["nu_rut"];
$dv = $_GET["nu_dv"];

$resultado = 0;

$proc = mssql_init("insert_cliente",$cn_licitaciones);
mssql_bind($proc,"@usuario",$usr,SQLVARCHAR,false, false);
mssql_bind($proc,"@rut",$rut,SQLVARCHAR,false, false);
mssql_bind($proc,"@dv",$dv,SQLVARCHAR,false, false);
mssql_bind($proc,"@nombre",$nombre,SQLVARCHAR,false, false);
mssql_bind($proc,"@paterno",$paterno,SQLVARCHAR,false, false);
mssql_bind($proc,"@materno",$materno,SQLVARCHAR,false, false);
mssql_bind($proc,"@fono",$fono,SQLVARCHAR,false, false);
mssql_bind($proc,"@result", $resultado, SQLVARCHAR, true, false, 20);
$data = mssql_execute($proc,true) or die("Fallo");
mssql_free_statement($proc);

echo $resultado;
?>