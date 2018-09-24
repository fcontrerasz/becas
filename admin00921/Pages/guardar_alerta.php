<?php include("../conexion/conecta.php"); ?>
<?php
session_start();

if(!$_GET){
	echo "-2";
	die;
}

if($_SESSION["idusuario"] == null){
	echo "-3";
}

$id = $_GET["idpunto"];
$usr = $_SESSION["idusuario"];
$pos = $_GET["pos"];
$rut = $_GET["rut"];
$fono = $_GET["fono"];
$glosa = $_GET["glosa"];

$resultado = 0;

$proc = mssql_init("insert_alerta",$cn_licitaciones);
mssql_bind($proc,"@idcliente",$id,SQLVARCHAR,false, false);
mssql_bind($proc,"@idusuario",$usr,SQLVARCHAR,false, false);
mssql_bind($proc,"@pos",$pos,SQLVARCHAR,false, false);
mssql_bind($proc,"@fono",$fono,SQLVARCHAR,false, false);
mssql_bind($proc,"@rut",$rut,SQLVARCHAR,false, false);
mssql_bind($proc,"@glosa",$glosa,SQLVARCHAR,false, false);
mssql_bind($proc,"@result", $resultado, SQLVARCHAR, true, false, 20);
$data = mssql_execute($proc,true) or die("99");
mssql_free_statement($proc);

echo $resultado;
?>