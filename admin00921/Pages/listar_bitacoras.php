<?php include("../conexion/conecta.php"); ?>
<?php
$query = -1;
if(isset($_GET["q"])){
$query = $_GET["q"];
}

$result = $db->query("select * from  listar_historicos_gestion WHERE IDPOSTULANTES = ".$query);
if($result){  
?>

<table id="sort02" class="rounded-corner" style="width:100%;padding: 0; margin:0;">
<thead>
     	<tr>
        	<td style="background-color:#E6F1F5; font-weight:bold;">VER</td>     	
            <td style="background-color:#E6F1F5; font-weight:bold;">FECHA</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">AGENTE</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">FONO</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">ACCION</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">GLOSA</td>
        </tr>
</thead>
<tbody>
<?php 
while ($row = $result->fetch_object()){
?>
     	<tr>
        	<td><a href="#" onclick="xenviar('<?php echo "TICKET: ".$row->IDGESTION."<br><br>GLOSA:".$row->GLOSA_GESTION; ?>');">VER</a></td>
        	<td><?php echo date("d/m/Y H:i:s",strtotime($row->FECHA_GESTION)); ?></td>     	
            <td><?php echo $row->USUARIO_NOMBRE; ?></td>
            <td><?php echo $row->FONO_GESTION; ?></td>
            <td style="font-size:11px;"><span class="xnivel1"><?php echo $row->TIPOS_NOMBRE."</span> -> <span class='xnivel2'>".$row->SUBTIPO_NOMBRE."</span> -> <span class='xnivel3'>".$row->RESOLUCION_NOMBRE."<span> "; ?></td>
            <td><?php echo $row->GLOSA_GESTION; ?></td>
        </tr>
<?php  }
     $result->close();
     $db->next_result();
} ?>

    </tbody>
     </table>
     
     <?php 
$db->close();
?>
