<?php include("../conexion/conecta.php"); ?>
<?php
$busqueda = -1;
if(isset($_GET["q"])){
$busqueda = $_GET["q"];
}

$result = $db->query("SELECT * from listar_maestro_contactos where IDPOSTULANTE=".$busqueda);
?>
<select name="cl_solicitante" id="cl_solicitante" class="text-normal">
<option value="0">-- SELECCIONE --</option>
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