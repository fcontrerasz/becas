<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php 

$rut = "-1";
if (isset($_GET['r'])) {
  $rut = $_GET['r'];
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

$query = "SELECT * FROM POSTULACIONES_WEB WHERE rut_trabajador = ".revisaSQL($rut, "text")." and IDTIPOBECA = ".revisaSQL($b, "int");
$result = $db->query($query);
//echo $query;
//echo "<br>";
if($result->num_rows == "0"){
	die("-1|0");
}
$result->close();
$db->next_result();


$query = "SELECT IDPOSTULACION FROM POSTULACIONES_WEB WHERE rut_trabajador = ".revisaSQL($rut, "text")." and dv_trabajador = ".revisaSQL($dv, "text")." and fecha_nacimiento = ".revisaSQL($f, "text")." and IDTIPOBECA = ".revisaSQL($b, "int");
$result = $db->query($query);
echo $result->num_rows;
if($result->num_rows>0){
	$row = $result->fetch_object();
	echo "|".$row->IDPOSTULACION;
}else{ echo "|0"; }
$result->close();
$db->next_result();

$db->close();

 ?>