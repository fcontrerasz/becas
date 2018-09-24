<?php require_once('../admin00921/conexion/conecta.php'); 
header('Content-typ: content="text/html; charset=UTF-8');
?>
<?php
if(!isset($_GET["f"]) || $_GET["f"] == "") die();


echo "<option value='0'>Seleccione</option>";


$result = $db->query("select * from  listar_comunas where IDREGIONES = ".$_GET["f"]);

if($result){
    while ($row = $result->fetch_object()){
		echo "<option value='".$row->IDCOMUNAS."'>".$row->COMUNA_NOMBRE."</option>";
    }
     $result->close();
     $db->next_result();
}
else echo($db->error);
echo "1";
$db->close();


 ?>