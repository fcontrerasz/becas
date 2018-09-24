<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?

if(!isset($_POST["forigen"])) die("-1");
if(!isset($_POST["data"])) die("-1");

$o = $_POST["forigen"];
$i = $_POST["fvivienda"];

//echo $o."<br>";

if($o == "contratoempresa"){
	$query = sprintf("CALL itiss_VIVIENDA_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "liquidaciones1"){
	$query = sprintf("CALL itiss_VIVIENDA_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "liquidaciones2"){
	$query = sprintf("CALL itiss_VIVIENDA_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "liquidaciones3"){
	$query = sprintf("CALL itiss_VIVIENDA_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "promesa"){
	$query = sprintf("CALL itiss_VIVIENDA_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "propiedad"){
	$query = sprintf("CALL itiss_VIVIENDA_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "deuda"){
	$query = sprintf("CALL itiss_VIVIENDA_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "declaracion"){
	$query = sprintf("CALL itiss_VIVIENDA_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else die("-1");

$result = $db->query($query);
$db->next_result();

$query = "SELECT @result as resultado, LAST_INSERT_ID() as id";
$result = $db->query($query);
$row = $result->fetch_object();
if($row->resultado=="1"){
	echo $row->resultado."|".$row->id;
}else{ echo $row->resultado."|0";  }
$result->close();
$db->next_result();

$db->close();



/*
// pull the raw binary data from the POST array
$data = substr($_POST['data'], strpos($_POST['data'], ",") + 1);
// decode it
$decodedData = base64_decode($data);
// print out the raw data,
$filename = $_POST['fname'];
$fp = fopen("tmp/".$filename, 'wb');
fwrite($fp, $decodedData);
fclose($fp);
//echo $decodedData;
*/

?>