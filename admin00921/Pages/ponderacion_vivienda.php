<?php include("../conexion/conecta.php"); ?>
<?php
if(!isset($_GET["i"])) die("-1");

$query = "select * from listar_datos_ponderacion WHERE IDPOSTULACION = ".$_GET["i"];

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows>0){

$row = $result->fetch_object();

$valor =$row->RENTA_TRABAJADOR;

$prenta = "";

if($valor < 250000){ $prenta =  '100';
}else if(250000 >= $valor && $valor <= 299999) {  $prenta =   '98';
}else if(300000 >= $valor && $valor <= 349999) {  $prenta =   '96';
}else if(350000 >= $valor && $valor <= 399999) {  $prenta =   '94';
}else if(400000 >= $valor && $valor <= 449999) {  $prenta =   '92';
}else if(450000 >= $valor && $valor <= 499999) {  $prenta =   '90';
}else if(500000 >= $valor && $valor <= 549999) {  $prenta =   '88';
}else if(550000 >= $valor && $valor <= 599999) {  $prenta =   '86';
}else if(600000 >= $valor && $valor <= 649999) {  $prenta =   '84';
}else if(650000 >= $valor && $valor <= 699999){  $prenta =  '82';
}else if(700000 >= $valor && $valor <= 749999){  $prenta =  '80';
}else if(750000 >= $valor && $valor <= 799999){  $prenta =  '78';
}else if(800000 >= $valor && $valor <= 849999){  $prenta =  '76';
}else if(850000 >= $valor && $valor <= 899999){  $prenta =  '74';
}else if(900000 >= $valor && $valor <= 949999){  $prenta =  '72';
}else if(950000 >= $valor && $valor <= 999999){  $prenta =  '70';
}else if(1000000 >= $valor && $valor <= 1049999){  $prenta =  '68';
}else if(1050000 >= $valor && $valor <= 1099999){  $prenta =  '66';
}else if(1100000 >= $valor && $valor <= 1149999){  $prenta =  '64';
}else if(1150000 >= $valor && $valor <= 1199999){  $prenta =  '62';
}else if(1200000 >= $valor && $valor <= 1249999){  $prenta =  '60';
}else if(1250000 >= $valor && $valor <= 1299999){  $prenta =  '58';
}else if(1300000 >= $valor && $valor <= 1349999){  $prenta =  '56';
}else if(1350000 >= $valor && $valor <= 1399999){  $prenta =  '54';
}else if(1400000 >= $valor && $valor <= 1449999){  $prenta =  '52';
}else if(1450000 >= $valor && $valor <= 1499999){  $prenta =  '50';
}else if(1500000 >= $valor && $valor <= 1549999){  $prenta =  '48';
}else if(1550000 >= $valor && $valor <= 1599999){  $prenta =  '46';
}else if(1600000 >= $valor && $valor <= 1649999){  $prenta =  '44';
}else if(1650000 >= $valor && $valor <= 1699999){  $prenta =  '42';
}else if(1700000 >= $valor && $valor <= 1749999){  $prenta =  '40';
}else if(1750000 >= $valor && $valor <= 1799999){  $prenta =  '38';
}else if(1800000 >= $valor && $valor <= 1849999){  $prenta =  '36';
}else if(1850000 >= $valor && $valor <= 1899999){  $prenta =  '34';
}else if(1900000 >= $valor && $valor <= 1949999){  $prenta =  '32';
}else if(1950000 >= $valor && $valor <= 1999999){  $prenta =  '30';
}else if(2000000 >= $valor && $valor <= 2049999){  $prenta =  '28';
}else if(2050000 >= $valor && $valor <= 2099999){  $prenta =  '26';
}else if(2100000 >= $valor && $valor <= 2149999){  $prenta =  '24';
}else if(2150000 >= $valor && $valor <= 2199999){  $prenta =  '22';
}else if(2200000 >= $valor && $valor <= 2249999){  $prenta =  '20';
}else if(2250000 >= $valor && $valor <= 2299999){  $prenta =  '18';
}else if(2300000 >= $valor && $valor <= 2349999){  $prenta =  '16';
}else if(2350000 >= $valor && $valor <= 2399999){  $prenta =  '14';
}else if(2400000 >= $valor && $valor <= 2449999){  $prenta =  '12';
}else if(2450000 >= $valor && $valor <= 2499999){  $prenta =  '10';
}else if(2500000 >= $valor){  $prenta = '10'; }


$valor2 = $row->INTEGRANTES;

if($valor2  > 5){ $pgrupof = '100';
}else if($valor2 == 4 ){ $pgrupof = '90'; 
}else if($valor2 == 3 ){ $pgrupof = '70'; 
}else if($valor2 == 2 ){ $pgrupof = '50'; 
}else if($valor2 == 1 ){ $pgrupof = '30'; }


$valor3 = $row->DESTINO_FONDO;

$pdestf = ($valor3  == 'COMPRA') ? '80':
		  ($valor3  == 'CONSTRUIR' ) ? '90':
		  ($valor3  == 'PREPAGO') ? '100':
		  '';

$valor4 = $row->COMUNA_NOMBRE;
$valor5 = $row->REGION_NOMBRE;
$valor6 = $row->REGION_NUMERO;

$pcomuna = '';

if($valor5 == 'Metropolitana de Santiago'){
$pcomuna = '100';
}else if($valor6 == 'II'||$valor6 == 'III'||$valor6 == 'V'||$valor6 == 'VI'){
$pcomuna = '70';
}




if(!isset($_GET["pond_2"])){
	$valorfinal = (0.5 * (1 * $prenta)) + (0.5 * ((0.4 * $pcomuna) + (0.3 * $pgrupof) + (0.3 * $pdestf)));
	echo $valor."|".$valor2."|".$valor3."|".$valor4."|".$valor5."|".$valor6."|".$prenta."|".$pcomuna."|".$pgrupof."|".$pdestf."|".round($valorfinal,0);
}else{
	$valorfinal = (0.5 * (1 * $prenta)) + (0.5 * ((0.4 * $_GET["pond_2"]) + (0.3 * $pgrupof) + (0.3 * $pdestf)));
	echo $valor."|".$valor2."|".$valor3."|".$valor4."|".$valor5."|".$valor6."|".$prenta."|".$_GET["pond_2"]."|".$pgrupof."|".$pdestf."|".round($valorfinal,0);
}
 
}

     $result->close();
     $db->next_result();
	 $db->close();
?>