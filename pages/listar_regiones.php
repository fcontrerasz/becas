<?php require_once('../admin00921/conexion/conecta.php'); 
header('Content-typ: content="text/html; charset=UTF-8');
?>
<?php

echo "<option value='0'>Seleccione</option>";
$result = $db->query("select * from  REGIONES");
if($result){
    while ($row = $result->fetch_object()){
		if($_GET["f"] == $row->IDREGIONES){	
			echo "<option selected='selected' value='".$row->IDREGIONES."'>".$row->REGION_NOMBRE."</option>";
		}else{
			echo "<option value='".$row->IDREGIONES."'>".$row->REGION_NOMBRE."</option>";
		}
    }
     $result->close();
     $db->next_result();
}
else echo($db->error);
echo "1";
$db->close();


 ?>