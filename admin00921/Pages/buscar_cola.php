<?php include("../conexion/conecta.php"); ?>
<?php

$variables = explode("?", $_SERVER['REQUEST_URI']);
parse_str($variables[1]);
$arr = get_defined_vars();

$buffer = "";

if(isset($q)){
$buffer = "";
}else if(isset($n)){
 if($n != ""){
	$tempInput = explode(" ",$n);
	foreach($tempInput as $values)
	{
		$buffer .= "NOMBRECOMPLETO like '%".$values."%' and ";
	}
	$buffer = substr($buffer,0,-4); 
	$buffer = " WHERE ".$buffer;
  }
}else if(isset($r)){
	if(!empty($r)){
		$buffer = "  WHERE RUT_TRABAJADOR = '".$r."'"; 
	}else{
		$buffer = ""; 
	}
  
}else if(isset($p)){
	if(!empty($p)){
		$buffer = "  WHERE RUT_POSTULANTE = '".$p."'"; 
	}else{
		$buffer = ""; 
	}
  
}

$query = "select * from listar_busqueda".$buffer." ORDER BY IDESTADOBECA DESC";

//echo $query;

$result = $db->query($query);
$numRows = $result->num_rows;

?>
<h3>RESULTADOS (<?php echo $numRows; ?>)</h3>
<table id="tabla_listar_cola" class="rounded-corner" style="width:100%;padding: 0; margin:0; font-size:11px;">
<thead>
     	<tr>     	
            <td style="background-color:#E6F1F5; font-weight:bold;">TRABAJADOR</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">POSTULANTE</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">NOMBRE</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">AUDITOR</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">BECA</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">ESTADO</td>
        </tr>
</thead>
<tbody>
<?php
if($result){
    while ($row = $result->fetch_object()){
	
	if($row->IDTIPOBECA == 1){
		$linkx = $row->IDPONDVIVIENDA;
	}else if($row->IDTIPOBECA == 2){
		$linkx = $row->IDPONDEDUCACION;
	}
?>
     	<tr>     	
<!--            <td><?php if(($row->IDEVALUADOR=="" || $row->IDEVALUADOR==$_SESSION["idusuario"]) && ($row->ESTADO_BECA=="OBSERVACIONES" || $row->ESTADO_BECA=="POSTULADA" || $row->ESTADO_BECA=="PENDIENTE AUDITOR")){ ?><a href="#" onclick="$(this).AbrirPostulacion('<?php echo $row->IDPOSTULACION; ?>','<?php echo $row->IDTIPOBECA; ?>','<?php echo $linkx; ?>');return false;"><?php } ?><?php echo $row->RUT_TRABAJADOR; ?></a></td>-->
            <td><a href="#" onclick="$(this).AbrirPostulacion('<?php echo $row->IDPOSTULACION; ?>','<?php echo $row->IDTIPOBECA; ?>','<?php echo $linkx; ?>');return false;"><?php echo $row->RUT_TRABAJADOR; ?></a></td>
            <td><?php echo $row->RUT_POSTULANTE; ?></td>
            <td><?php echo $row->NOMBRE_TRABAJADOR." ".$row->PATERNO_TRABAJADOR." ".$row->MATERNO_TRABAJADOR; ?></td>
            <td><?php if($row->IDEVALUADOR==""){ ?><span><a href='#' class='inline-link-g2'>NUEVO</a></span><?php }else if($row->IDEVALUADOR==$_SESSION["idusuario"]){ ?><span><a href='#' class='inline-link-g3'>TUYO</a></span> <? }else{ ?><span><a href='#' class='inline-link-g1'>TOMADO</a></span> <? } ?></td>
            <td><?php echo $row->IDVIVIENDA>0?"VIVIENDA":"ESTUDIOS"; ?></td>
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
