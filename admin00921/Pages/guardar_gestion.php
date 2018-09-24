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
}

$id = $_GET["op_id"];
$usr = $_GET["op_usuario"];
$tipo = $_GET["cl_tipos"];
$subtipo = $_GET["cl_subtipo"];
$resolu = $_GET["cl_resolucion"];
$contacto = $_GET["cl_solicitante"];
$fono = $_GET["op_fono"];
$glosa = $_GET["op_glosa"];
$detalle = $_GET["cl_detalle"];

//var_dump($glosa);

$resultado = 0;

$query = @"INSERT INTO GESTION (IDTIPOS, IDRESOLUCION, IDMEDIOS, IDPOSTULANTES, IDSUBTIPO, IDUSUARIO, IDORIGENPUBLICIDAD, FECHA_GESTION, CONTACTO_GESTION, FONO_GESTION, GLOSA_GESTION) VALUES (".$tipo.", ".$detalle.", 1, ".$id.", ".$subtipo.", ".$_SESSION["idusuario"].", 1, now(), '".$contacto."', '".$fono."', '".$glosa."')";

//echo $query;

$result = $db->query($query);
//or die(mysqli_error($db));
if($result){  
	$resultado = 1;
}
$db->close();

/*
$proc = mssql_init("insert_gestion",$cn_licitaciones);
mssql_bind($proc,"@idcliente",$id,SQLVARCHAR,false, false);
mssql_bind($proc,"@usuario",$usr,SQLVARCHAR,false, false);
mssql_bind($proc,"@tipo",$tipo,SQLVARCHAR,false, false);
mssql_bind($proc,"@subtipo",$subtipo,SQLVARCHAR,false, false);
mssql_bind($proc,"@detalle",$detalle,SQLVARCHAR,false, false);
mssql_bind($proc,"@resolucion",$resolu,SQLVARCHAR,false, false);
mssql_bind($proc,"@contacto",$contacto,SQLVARCHAR,false, false);
mssql_bind($proc,"@fono",$fono,SQLVARCHAR,false, false);
mssql_bind($proc,"@glosa",$glosa,SQLTEXT,false, false);
mssql_bind($proc,"@result", $resultado, SQLVARCHAR, true, false, 20);
$data = mssql_execute($proc,true) or die("Fallo");
mssql_free_statement($proc);
*/
echo $resultado;
?>