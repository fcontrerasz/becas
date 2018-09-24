<?php include("../conexion/conecta.php"); ?>
<?php

$variables = explode("?", $_SERVER['REQUEST_URI']);
parse_str($variables[1]);

if ($_SERVER['HTTP_X_REQUESTED_WITH'] != "XMLHttpRequest"){ die("-5"); }


$arr = get_defined_vars();
//var_dump($arr);
//echo $variables[1];
//echo $variables[1];

if(!isset($p)) die("-1");
if(!isset($l)) die("-1");
$query = "";
if($b == 2){
	$query = "UPDATE PONDERACION_EDUCACION SET OBS_PASO".$p." = '".$t."' WHERE IDPONDEDUCACION = ".revisaSQL($l, "int");
}

if($b == 1){
	$query = "UPDATE PONDERACION_VIVIENDA SET OBS_PASO".$p." = '".$t."' WHERE IDPONDVIVIENDA = ".revisaSQL($l, "int");
}
//echo $query;

$result = $db->query($query);
if($result){
echo "1";
}else{echo "0|".$db->error;}
$db->next_result();


?>