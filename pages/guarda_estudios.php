<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php 

$cod = explode("?", $_SERVER['REQUEST_URI']);
$variables = base64_decode($cod[1]);
parse_str($variables);

//echo "<br><br>";
//$arr = get_defined_vars();
//var_dump($arr);
if(!isset($p)) die("-1");
if(!isset($i)) die("-1");



if($p == 1){


$fechanacimiento = "";
if($fechanacimiento != ""){
	$date = explode('/', $fechanacimiento);
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$fechanacimiento = date( 'Y-m-d H:i:s', $time );
}


$query = sprintf("CALL itiss_POSTULACIONES_WEB_upd (%s, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, %s, %s, %s, NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NULL, NULL, NULL, @result);", revisaSQL($i, "int"), revisaSQL($nombres, "text"), revisaSQL($paterno, "text"), revisaSQL($materno, "text"),revisaSQL($sexo, "text"),revisaSQL($direccion, "text"),revisaSQL($numero, "text"),revisaSQL($depto, "text"),revisaSQL($villa, "text"),revisaSQL($correo, "text"),revisaSQL($prefijofijo."-".$fonofijo, "text"),revisaSQL($prefijocelu."-".$celular, "text"),revisaSQL($region, "int"),revisaSQL($comuna, "int"),revisaSQL($renta, "int"),revisaSQL($estadocivil, "text"),revisaSQL($integrantes, "int"));

//echo $query ;

/*
$query = sprintf("CALL itiss_POSTULACIONES_WEB_upd (%s, 1, 1, %s-rutemp, %s-dvemp, %s-razon, %s-contrato, %s-fechacontr, %s-division, %s-ruttrab, %s-dvtrab, %s, %s, %s, %s, %s(sexo), %s-dire, %s-num, %s-dpto, %s-villa, %s-correo, %s-fono, %s-celu, %s-region, %s-comuna, %s-renta, %s-ecivil, %s-integra, %s-tipoempresa,  @result);", revisaSQL($i, "int"), revisaSQL($nombres, "text"), revisaSQL($paterno, "text"), revisaSQL($materno, "text"),revisaSQL($fechanacimiento, "text"),revisaSQL($correo, "text"),revisaSQL($fonofijo, "text"),revisaSQL($celular, "text"));
*/

//echo $query;

//die();

}

if($p == 2){

//echo $variables;
$fechatermino = "";
if($fechatermino != ""){
	$date = explode('/', $fechatermino);
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$fechatermino = date( 'Y-m-d H:i:s', $time );
}

$query = sprintf("CALL itiss_POSTULACIONES_WEB_upd (%s, 1, 2, %s, %s, %s, %s, %s, %s, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, %s, %s, %s, @result);", revisaSQL($i, "int"), revisaSQL($rutempresa, "int"), revisaSQL($dvempresa, "int"),revisaSQL($razon, "text"),revisaSQL($contrato, "text"),revisaSQL($fechatermino, "text"),revisaSQL($division, "text"), revisaSQL($tipoempresa, "text"),revisaSQL($correoempresa, "text"),revisaSQL($prefijoempresa."-".$fonoempresa, "text"));

}

if($p == 3){
//echo $variables;

if($fechanacimientopost != ""){
	$date = explode('/', $fechanacimientopost);
	$time = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$fechanacimientopost = date( 'Y-m-d H:i:s', $time );
}
if (strpos($promediobene,'.') !== false) {
    $promediobene = str_replace(".",",",$promediobene);
}

//echo $promediobene."<---";

$query = sprintf("CALL itiss_EDUCACION_upd (%s, NULL,NULL,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($v, "int"),revisaSQL($hijoseducados, "text"),revisaSQL($destino, "text"),revisaSQL($rutbene, "text"),revisaSQL($dvbene, "text"),revisaSQL($nombrebene, "text"),revisaSQL($paternobene, "text"),revisaSQL($maternobene, "text"),revisaSQL($ensenanzabene, "text"),revisaSQL($anteriorbene, "text"),revisaSQL($promediobene, "text"),revisaSQL($establecibene, "text"),revisaSQL($carrerabene, "text"),revisaSQL($fechanacimientopost, "text"),revisaSQL($sexo, "text"));

//$query = sprintf("CALL itiss_VIVIENDA_upd (%s,NULL,NULL,%s,%s,%s,%s,%s,%s,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($v, "int"),revisaSQL($destino, "text"),revisaSQL($direccionvivienda, "text"),revisaSQL($numerovivienda, "text"),revisaSQL($deptovivienda, "text"),revisaSQL($villavivienda, "text"),revisaSQL($fondo_comuna, "int"),revisaSQL($fondo_region, "int"));

//echo $query;
//$query = sprintf("CALL itiss_VIVIENDA_upd (idvivienda	, idpond,idpostu,fondo,dire,num,dpto,villa,comuna,region,acpta,contrato,liq1,liq2,liq3,promesa,propiedad,deuda,declaracion,@result);",revisaSQL($v, "int"));

}

if($p == 4){
//echo $variables;

if(isset($condiciones)){
 $condiciones = 1;
}else $condiciones = 0;

$query = sprintf("CALL itiss_EDUCACION_upd (%s, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,@result);",revisaSQL($v, "int"),revisaSQL($condiciones, "int"));
//$query = sprintf("CALL itiss_VIVIENDA_upd (%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($v, "int"),revisaSQL($condiciones, "int"));

//echo $query;
//$query = sprintf("CALL itiss_VIVIENDA_upd (idvivienda	, idpond,idpostu,fondo,dire,num,dpto,villa,comuna,region,acpta,contrato,liq1,liq2,liq3,promesa,propiedad,deuda,declaracion,@result);",revisaSQL($v, "int"));

}

$result = $db->query($query);
if(!$result) echo($db->error);
$db->next_result();


$query = "SELECT @result as resultado";
$result = $db->query($query);
$row = $result->fetch_object();
echo $row->resultado;
$result->close();
$db->next_result();

$db->close();

?>