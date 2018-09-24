<?php include("../conexion/conecta.php"); ?>
<?php

$ciudad = -1;
if(isset($_GET["subtipo"])){
$ciudad = $_GET["subtipo"];
}

$query = "SELECT * from RESOLUCION where IDSUBTIPO = ".$ciudad;
//echo $query;
$result = $db->query($query);
?>
<select name="cl_detalle" id="cl_detalle" class="text-normal">
<option value="0">-- SELECCIONE --</option>
<?php 
if($result){  
while ($row = $result->fetch_object()){
?>
<option value="<?php echo $row->IDRESOLUCION; ?>"><?php echo $row->RESOLUCION_NOMBRE; ?></option>
<?php  }
     $result->close();
     $db->next_result();
} ?>
</select>
<?php 
$db->close();
?>