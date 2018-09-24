<?php include("../conexion/conecta.php"); ?>
<?php

$variables = explode("?", $_SERVER['REQUEST_URI']);
parse_str($variables[1]);
$arr = get_defined_vars();
$query = "select * from listar_busqueda where RUT_TRABAJADOR = ".revisaSQL($q, "text");

$result = $db->query($query);
$numRows = $result->num_rows;

?>
<h3>RESULTADOS (<?php echo $numRows; ?>)</h3>
<table id="sort02" class="rounded-corner" style="width:100%;padding: 0; margin:0;">
<thead>
     	<tr>     	
            <td style="background-color:#E6F1F5; font-weight:bold;">RUT</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">NOMBRE</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">BECA</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">DIRECCION</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">ESTADO</td>
        </tr>
</thead>
<tbody>
<?php
if($result){
    while ($row = $result->fetch_object()){
?>
     	<tr>     	
            <td><a href="#" onclick="$(this).AbrirGestion('<?php echo $row->IDPOSTULANTES; ?>');return false;"><?php echo $row->POSTULANTE_RUT; ?></a></td>
            <td><?php echo $row->NOMBRE_TRABAJADOR." ".$row->PATERNO_TRABAJADOR." ".$row->MATERNO_TRABAJADOR; ?></td>
            <td><?php echo $row->IDVIVIENDA>0?"VIVIENDA":"ESTUDIOS"; ?></td>
            <td><?php echo $row->NOMBRE_TRABAJADOR; ?></td>
            <td <?php if($row->ESTADO_BECA=="EN CURSO"){ ?>style='background-color:#D40D12; color:#FFFFFF;' <?php }elseif($row->ESTADO_BECA=="POSTULADA"){ ?>style='background-color:#BBFF80; color:#000;' <?php }else{ ?>style='background-color:#F0D770; color:#000;' <?php } ?>><?php echo $row->ESTADO_BECA; ?></td>
        </tr>
 <?php   }
     $result->close();
     $db->next_result();
}
else echo($db->error);
$db->close();
?>
    </tbody>
     </table>
