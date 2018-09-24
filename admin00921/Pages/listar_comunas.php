<?php include("../conexion/conecta.php"); ?>
<?php

$ciudad = 1;
if(isset($_GET["ciudad"])){
$ciudad = $_GET["ciudad"];
}

$result = $db->query("select * from  listar_comunas where IDREGIONES = ".$ciudad);
if($result){  

?>
<select name="cl_comuna" id="cl_comuna" class="text-normal">
<?php 
while ($row = $result->fetch_object()){
?>
<option value="<?php echo $row->IDCOMUNAS; ?>"><?php echo $row->COMUNA_NOMBRE; ?></option>
<?php  }
     $result->close();
     $db->next_result();
} ?>
</select>
<?php 
$db->close();
?>