<?php include("../conexion/conecta.php"); ?>
<?php
if(!isset($_GET["i"])) die("-1");
if(!isset($_GET["b"])) die("-1");

$query = "select * from listar_resumen_basico WHERE IDPOSTULACION = ".revisaSQL($_GET["i"], "int")." and IDTIPOBECA = ".revisaSQL($_GET["b"], "int");

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows>0){

$row = $result->fetch_object();

$renta = "$".number_format($row->RENTA_TRABAJADOR, 0);

?>
<H4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">NOMBRE</span> <?php echo $row->NOMBRETRABAJADOR; ?></H4>
<H4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">RUT</span> <?php echo $row->RUTEMPLEADO; ?></H4>
<H4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">TIPO DE EMPRESA</span> <?php echo $row->TIPO_EMPRESA; ?></H4>
<H4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">RUT EMPRESA</span> <?php echo $row->RUTEMPRESA; ?></H4>
<H4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">RAZON SOCIAL</span> <?php echo $row->RAZONSOCIAL; ?></H4>
<H4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">FECHA CONTRATISTA</span> <?php echo $row->FECHA_CONTRATO; ?></H4>
<H4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">NUMERO CONTRATO</span> <?php echo $row->CONTRATO; ?></H4>
<H4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">DIVISION</span> <?php echo $row->DIVISION; ?></H4>
<H4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">RENTA</span> <?php echo $renta; ?></H4>



<?
}

$result->close();
$db->next_result();
$db->close();
 

?>