<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php
if(!isset($_GET["f"])) die("-1");
if(!isset($_GET["v"])) die("-1");
$v = $_GET["v"];
$o = $_GET["f"];

if($o == "contratoempresa"){
	$query = "SELECT ARCHIVO_CONTRATO as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
}else if($o == "liquidaciones1"){
	$query = "SELECT ARCHIVO_LIQ1 as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
}else if($o == "liquidaciones2"){
	$query = "SELECT ARCHIVO_LIQ2 as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
}else if($o == "liquidaciones3"){
	$query = "SELECT ARCHIVO_LIQ3 as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
}else if($o == "promesa"){
	$query = "SELECT ARCHIVO_PROMESA as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
}else if($o == "propiedad"){
	$query = "SELECT ARCHIVO_PROPIEDAD as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
}else if($o == "deuda"){
	$query = "SELECT ARCHIVO_DEUDA as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
}else if($o == "declaracion"){
	$query = "SELECT ARCHIVO_DECLARACION as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
}else die("-1");

//$query = "SELECT ARCHIVO_CONTRATO as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
$result = $db->query($query);


if($result->num_rows>0){
	$row = $result->fetch_object();
	$archivo = $row->data;
	var_dump($archivo);
	die();
	$data = substr($archivo, strpos($archivo, ",") + 1);
	$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
	$decodedData = base64_decode($data);
	/*$filename = 'demo.txt';
	$fp = fopen("tmp/".$filename, 'wb');
	fwrite($fp, $decodedData);
	fclose($fp);*/
}
$result->close();
$db->next_result();
$db->close();

header("Content-Type: ".$tipoarchivo);

$extension = "";
switch($tipoarchivo)
{
    case 'image/gif'    : $extension = 'gif';   break;
    case 'image/png'    : $extension = 'png';   break;
    case 'image/jpeg'   : $extension = 'jpg';   break;
    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   : $extension = 'docx';   break;
    case 'application/msword'    : $extension = 'doc';   break;
    case 'image/tiff'    : $extension = 'tif';   break;
    case 'application/pdf'   : $extension = 'pdf';   break;
    default : $extension = 'txt'; break;
}

//echo $tipoarchivo."|".$extension;
header('Content-Disposition: inline; filename="archivo.'.$extension.'"');
echo $decodedData;



?>