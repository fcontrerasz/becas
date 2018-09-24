<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php 

$rut = "-1";
$variables = explode("?", $_SERVER['REQUEST_URI']);
parse_str($variables[1]);
$arr = get_defined_vars();
//var_dump($arr);
//echo $variables[1];
$ultimo = 0;

$query = sprintf("CALL `itiss_POSTULACIONES_WEB_upd` (NULL, 1, %s, NULL, NULL, NULL, NULL, NULL, NULL, %s, %s, NULL, NULL, NULL, %s, NULL, NULL, NULL, NULL, NULL, %s, NULL, %s, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, @result);",revisaSQL($b,"int"), revisaSQL($r, "text"),revisaSQL($dv, "text"),revisaSQL($c, "text"),revisaSQL($m, "text"),revisaSQL("09-".$f, "text"));
$result = $db->query($query);
$db->next_result();

//echo $query;

$query = "SELECT @result as resultado, LAST_INSERT_ID() as id";
$result = $db->query($query);
$row = $result->fetch_object();
if($row->resultado=="1"){
	$ultimo = $row->id;
	echo $row->resultado."|".$row->id;
}else{ echo $row->resultado."|0";  }
$result->close();
$db->next_result();

if($ultimo>0){
	if($b == "1"){
		$query = sprintf("CALL itiss_VIVIENDA_upd (NULL, NULL,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($ultimo, "int"));
	}else if($b == "2"){
		$query = sprintf("CALL itiss_EDUCACION_upd (NULL, NULL,%s,NULL,NULL,%s,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($ultimo, "int"),revisaSQL($rp, "int"),revisaSQL($dp, "text"));
	}
	//echo $query;
	$result = $db->query($query);
	$db->next_result();
}
$db->close();

?>