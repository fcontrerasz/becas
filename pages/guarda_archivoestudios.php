<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php

if(!isset($_POST["forigen"])) die("-1");
if(!isset($_POST["data"])) die("-1");

$o = $_POST["forigen"];
$i = $_POST["fvivienda"];

//echo $_POST["data"];
//echo $o."<br>";

if($o == "contratoempresa"){
	$query = sprintf("CALL itiss_EDUCACION_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "liquidaciones1"){
	$query = sprintf("CALL itiss_EDUCACION_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "liquidaciones2"){
	$query = sprintf("CALL itiss_EDUCACION_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "liquidaciones3"){
	$query = sprintf("CALL itiss_EDUCACION_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "regular"){
	$query = sprintf("CALL itiss_EDUCACION_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "certnotas"){
	$query = sprintf("CALL itiss_EDUCACION_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "declaracion"){
	$query = sprintf("CALL itiss_EDUCACION_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "certnac"){
	$query = sprintf("CALL itiss_EDUCACION_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "certmatri"){
	$query = sprintf("CALL itiss_EDUCACION_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else if($o == "decljurada"){
	$query = sprintf("CALL itiss_EDUCACION_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,@result);",revisaSQL($i, "int"),revisaSQL($_POST["data"], "text"));
}else die("-1");

/*
echo $query;
$filename = 'demo.txt';
$fp = fopen("tmp/".$filename, 'wb');
fwrite($fp, $query);
fclose($fp);
*/
$result = $db->query($query);

//echo("Error description: " . mysqli_error($db));

$db->next_result();

$query = "SELECT @result as resultado, LAST_INSERT_ID() as id";
$result = $db->query($query);
$row = $result->fetch_object();

//echo "--->".$row->resultado."<---";

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