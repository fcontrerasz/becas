<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php 

$c = "-1";
if (isset($_GET['c'])) {
  $c = $_GET['c'];
}

$query = "SELECT * FROM BUSCAR_TICKET WHERE RUT like '%".$c."%'";

$result = $db->query($query);
if($result->num_rows == "0"){
	die("-1");
}else{
	die("1");
}
$result->close();
$db->next_result();
$db->close();

 ?>