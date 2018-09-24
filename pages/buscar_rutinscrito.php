<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php 
require 'phpmailer/PHPMailerAutoload.php';

$rut = "-1";
if (isset($_GET['r'])) {
  $rut = $_GET['r'];
  if (0 === strpos($rut, '0')) {
    $rut = ltrim ($_GET['r'], '0');
  }
}
$dv = "-1";
if (isset($_GET['d'])) {
  $dv = $_GET['d'];
}
$f = "-1";
if (isset($_GET['f'])) {
  $f = $_GET['f'];
}

$b = "-1";
if (isset($_GET['b'])) {
  $b = $_GET['b'];
}

$rutp = "-1";
if (isset($_GET['rp'])) {
  $rutp = $_GET['rp'];
  if (0 === strpos($rutp, '0')) {
    $rutp = ltrim ($_GET['rp'], '0');
  }
}
$dvp = "-1";
if (isset($_GET['dp'])) {
  $dvp = $_GET['dp'];
}

$query = "SELECT * FROM RUT_PERMITIDOS WHERE RUT = ".revisaSQL($rut, "text");
$result = $db->query($query);
//die($query);
if($result->num_rows == "0"){
	$email = new PHPMailer();
    $mail->SMTPDebug = 3;   
	$email->IsHTML(false); 
	$email->CharSet = 'UTF-8';
	$email->From      = 'autonomo@oticdelaconstruccion.cl';
	$email->FromName  = 'Becas - Postulación de Estudios';
	$email->Subject   = 'ALERTA - Postulación RUT Incorrecto';
	$email->Body      = 'El RUT '.$rut.'-'.$dv.' está intentando postular.';
	$email->AddAddress( 'avale003@codelco.cl' );
	$email->AddBCC('nabarca@ccc.cl');
	$email->AddBCC('ayuda@oticdelaconstruccion.cl');
	$email->send();
	die("-3|0");
}
$result->close();
$db->next_result();

$query = "SELECT * FROM POSTULACIONES_WEB WHERE rut_trabajador = ".revisaSQL($rut, "text")." and IDTIPOBECA = ".revisaSQL($b, "int");
$result = $db->query($query);
//echo $query;
//echo "<br>";
if($result->num_rows == "0"){
	die("-1|0");
}
$result->close();
$db->next_result();

//$query = "SELECT IDPOSTULACION FROM POSTULACIONES_WEB WHERE rut_trabajador = ".revisaSQL($rut, "text")." and dv_trabajador = ".revisaSQL($dv, "text")." and fecha_nacimiento = ".revisaSQL($f, "text")." and IDTIPOBECA = ".revisaSQL($b, "int");

if($b == "2"){
	$query = "SELECT IDPOSTULACION FROM listar_maestro_postulaciones_educacion WHERE rut_trabajador = ".revisaSQL($rut, "text")." and dv_trabajador = ".revisaSQL($dv, "text")." and fecha_nacimiento = ".revisaSQL($f, "text")." and IDTIPOBECA = ".revisaSQL($b, "int")." and rut_postulante is null";
}

$result = $db->query($query);
if($result->num_rows>0){
	$row = $result->fetch_object();
	die("-4|".$row->IDPOSTULACION);
}
$result->close();
$db->next_result();


$query = "SELECT * FROM listar_maestro_postulaciones_educacion WHERE rut_postulante = ".revisaSQL($rutp, "text")." and rut_trabajador = ".revisaSQL($rut, "text");
$result = $db->query($query);
//echo $query;
//echo "<br>";
if($result->num_rows == 0){
	die("-1|0");
}
$result->close();
$db->next_result();


if($b == "2"){
	$query = "SELECT IDPOSTULACION FROM listar_maestro_postulaciones_educacion WHERE rut_trabajador = ".revisaSQL($rut, "text")." and dv_trabajador = ".revisaSQL($dv, "text")." and fecha_nacimiento = ".revisaSQL($f, "text")." and IDTIPOBECA = ".revisaSQL($b, "int")." and rut_postulante = ".revisaSQL($rutp, "text")." and dv_postulante = ".revisaSQL($dvp, "text");
}

$result = $db->query($query);
if($result->num_rows>0){
	$row = $result->fetch_object();
	die("1|".$row->IDPOSTULACION);
}else die("-2|0");
$result->close();
$db->next_result();



$db->close();

 ?>