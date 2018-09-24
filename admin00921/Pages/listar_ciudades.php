<?php include("../conexion/conecta.php");
header('Content-typ: content="text/html; charset=UTF-8');

$ciudad = 1;
if(isset($_GET["ciudad"])){
$ciudad = $_GET["ciudad"];
}
echo '<select name="cl_ciudad" id="cl_ciudad" class="text-normal">';
echo "<option value='0'>Seleccione</option>";
$result = $db->query("select * from  REGIONES");
if($result){
    while ($row = $result->fetch_object()){
		if($ciudad == $row->IDREGIONES){	
			echo "<option selected='selected' value='".$row->IDREGIONES."'>".$row->REGION_NOMBRE."</option>";
		}else{
			echo "<option value='".$row->IDREGIONES."'>".$row->REGION_NOMBRE."</option>";
		}
    }
     $result->close();
     $db->next_result();
}
else echo($db->error);
echo "</select>";
$db->close();


 ?>