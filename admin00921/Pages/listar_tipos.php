<?php include("../conexion/conecta.php"); ?>
<?php
$result = $db->query("select * from  TIPOS ");
if($result){  
?>
<select name="cl_tipos" id="cl_tipos" class="text-normal">
<option value="0">-- SELECCIONE --</option>
<?php 
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