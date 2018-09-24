<?php include("../conexion/conecta.php"); ?>
<?php

$ciudad = -1;
if(isset($_GET["tipo"])){
$ciudad = $_GET["tipo"];
}

$query = "SELECT * from SUBTIPOS where IDTIPOS = ".$ciudad;
$result = $db->query($query);
?>
<select name="cl_subtipo" id="cl_subtipo" class="text-normal">
<option value="0">-- SELECCIONE --</option>
<?php 
if($result){  
while ($row = $result->fetch_object()){
?>
<option value="<?php echo $row->IDSUBTIPO; ?>"><?php echo $row->SUBTIPO_NOMBRE; ?></option>
<?php  }
     $result->close();
     $db->next_result();
} ?>
</select>
<?php 
$db->close();
?>