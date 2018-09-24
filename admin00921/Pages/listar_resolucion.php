<?php include("../conexion/conecta.php"); ?>
<?php

$ciudad = -1;
if(isset($_GET["tipo"])){
$ciudad = $_GET["tipo"];
}

$query = "SELECT * from RESOLUCION where IDSUBTIPO = ".$ciudad;
$result = $db->query($query);
?>
<select name="cl_resolucion" id="cl_resolucion" class="text-normal">
<option value="1">-- SELECCIONE --</option>
<?php 
if($result){  
while ($row = $result->fetch_object()){
?>
<option value="<?php echo $row->IDTIPOS; ?>"><?php echo $row->TIPOS_NOMBRE; ?></option>
<?php  }
     $result->close();
     $db->next_result();
} ?>
</select>
<?php 
$db->close();
?>