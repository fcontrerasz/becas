<?php include("../conexion/conecta.php"); ?>
<?php
if(!isset($_GET["i"])) die("-1");

function truncateFloat($number, $digitos)
{
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos);
 
}

$query = "select * from listar_datos_ponderacion_estudios WHERE IDPOSTULACION = ".$_GET["i"];
//echo $query;
$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows < 1){
 die("-1");
}

if($numRows>0){

$row = $result->fetch_object();

$valor =$row->RENTA_TRABAJADOR_BASE;

$prenta = "";

// if($valor < 250000){ $prenta =  '100';
// }else if(250000 <= $valor && $valor <= 299999) {  $prenta =   '98';
// }else if(300000 <= $valor && $valor <= 349999) {  $prenta =   '96';
// }else if(350000 <= $valor && $valor <= 399999) {  $prenta =   '94';
// }else if(400000 <= $valor && $valor <= 449999) {  $prenta =   '92';
// }else if(450000 <= $valor && $valor <= 499999) {  $prenta =   '90';
// }else if(500000 <= $valor && $valor <= 549999) {  $prenta =   '88';
// }else if(550000 <= $valor && $valor <= 599999) {  $prenta =   '86';
// }else if(600000 <= $valor && $valor <= 649999) {  $prenta =   '84';
// }else if(650000 <= $valor && $valor <= 699999){  $prenta =  '82';
// }else if(700000 <= $valor && $valor <= 749999){  $prenta =  '80';
// }else if(750000 <= $valor && $valor <= 799999){  $prenta =  '78';
// }else if(800000 <= $valor && $valor <= 849999){  $prenta =  '76';
// }else if(850000 <= $valor && $valor <= 899999){  $prenta =  '74';
// }else if(900000 <= $valor && $valor <= 949999){  $prenta =  '72';
// }else if(950000 <= $valor && $valor <= 999999){  $prenta =  '70';
// }else if(1000000 <= $valor && $valor <= 1049999){  $prenta =  '68';
// }else if(1050000 <= $valor && $valor <= 1099999){  $prenta =  '66';
// }else if(1100000 <= $valor && $valor <= 1149999){  $prenta =  '64';
// }else if(1150000 <= $valor && $valor <= 1199999){  $prenta =  '62';
// }else if(1200000 <= $valor && $valor <= 1249999){  $prenta =  '60';
// }else if(1250000 <= $valor && $valor <= 1299999){  $prenta =  '58';
// }else if(1300000 <= $valor && $valor <= 1349999){  $prenta =  '56';
// }else if(1350000 <= $valor && $valor <= 1399999){  $prenta =  '54';
// }else if(1400000 <= $valor && $valor <= 1449999){  $prenta =  '52';
// }else if(1450000 <= $valor && $valor <= 1499999){  $prenta =  '50';
// }else if(1500000 <= $valor && $valor <= 1549999){  $prenta =  '48';
// }else if(1550000 <= $valor && $valor <= 1599999){  $prenta =  '46';
// }else if(1600000 <= $valor && $valor <= 1649999){  $prenta =  '44';
// }else if(1650000 <= $valor && $valor <= 1699999){  $prenta =  '42';
// }else if(1700000 <= $valor && $valor <= 1749999){  $prenta =  '40';
// }else if(1750000 <= $valor && $valor <= 1799999){  $prenta =  '38';
// }else if(1800000 <= $valor && $valor <= 1849999){  $prenta =  '36';
// }else if(1850000 <= $valor && $valor <= 1899999){  $prenta =  '34';
// }else if(1900000 <= $valor && $valor <= 1949999){  $prenta =  '32';
// }else if(1950000 <= $valor && $valor <= 1999999){  $prenta =  '30';
// }else if(2000000 <= $valor && $valor <= 2049999){  $prenta =  '28';
// }else if(2050000 <= $valor && $valor <= 2099999){  $prenta =  '26';
// }else if(2100000 <= $valor && $valor <= 2149999){  $prenta =  '24';
// }else if(2150000 <= $valor && $valor <= 2199999){  $prenta =  '22';
// }else if(2200000 <= $valor && $valor <= 2249999){  $prenta =  '20';
// }else if(2250000 <= $valor && $valor <= 2299999){  $prenta =  '18';
// }else if(2300000 <= $valor && $valor <= 2349999){  $prenta =  '16';
// }else if(2350000 <= $valor && $valor <= 2399999){  $prenta =  '14';
// }else if(2400000 <= $valor && $valor <= 2449999){  $prenta =  '12';
// }else if(2450000 <= $valor && $valor <= 2499999){  $prenta =  '10';
// }else if(2500000 <= $valor){  $prenta = '10'; }

$prenta = $valor;
//echo "----->".$prenta."<----";

$valor2 = $row->INTEGRANTES;

if($valor2  >= 5){ $pgrupof = '100';
}else if($valor2 == 4 ){ $pgrupof = '90'; 
}else if($valor2 == 3 ){ $pgrupof = '80'; 
}else if($valor2 == 2 ){ $pgrupof = '70'; 
}else if($valor2 < 2 ){ $pgrupof = '0'; }


$valor3 = $row->PROMEDIONOTAS_POSTULANTE;

$aux11 = str_replace(",", ".",$row->PROMEDIONOTAS_POSTULANTE);
$aux11 = truncateFloat($aux11,1);
$aux11 = str_replace(".", ",",$aux11);
$valor3 = $aux11;

if($valor3  == '7' || $valor3  == '7,0'){ $pnota = '100'; 
}else if($valor3  == '6,9' ){ $pnota = '97,5';
}else if($valor3  == '6,8' ){ $pnota = '95,0';
}else if($valor3  == '6,7' ){ $pnota = '92,5';
}else if($valor3  == '6,6' ){ $pnota = '90,0';
}else if($valor3  == '6,5' ){ $pnota = '87,5';
}else if($valor3  == '6,4' ){ $pnota = '85,0';
}else if($valor3  == '6,3' ){ $pnota = '82,5';
}else if($valor3  == '6,2' ){ $pnota = '80,0';
}else if($valor3  == '6,1' ){ $pnota = '77,5';
}else if($valor3  == '6,0' ){ $pnota = '75,0';
}else if($valor3  == '5,9' ){ $pnota = '72,5';
}else if($valor3  == '5,8' ){ $pnota = '70,0';
}else if($valor3  == '5,7' ){ $pnota = '67,5';
}else if($valor3  == '5,6' ){ $pnota = '65,0';
}else if($valor3  == '5,5' ){ $pnota = '62,5';
}else if($valor3  == '5,4' ){ $pnota = '60,0';
}else if($valor3  == '5,3' ){ $pnota = '57,5';
}else if($valor3  == '5,2' ){ $pnota = '55,0';
}else if($valor3  == '5,1' ){ $pnota = '52,5';
}else if($valor3  == '5,0' ){ $pnota = '50,0';
}else if($valor3  == '4,9' ){ $pnota = '47,5';
}else if($valor3  == '4,8' ){ $pnota = '45,0';
}else if($valor3  == '4,7' ){ $pnota = '42,5';
}else if($valor3  == '4,6' ){ $pnota = '40,0';
}else if($valor3  == '4,5' ){ $pnota = '37,5';
}else if($valor3  == '4,4' ){ $pnota = '35,0';
}else if($valor3  == '4,3' ){ $pnota = '32,5';
}else if($valor3  == '4,2' ){ $pnota = '30,0';
}else if($valor3  == '4,1' ){ $pnota = '27,5';
}else if($valor3  == '4,0' ){ $pnota = '25,0';
}else{ $pnota = '0'; }  

	  
$valor4 = "";
$valor5 = $row->ANTENSENA_POSTULANTE;

if($valor5 == 'UNIVERSIDAD'){ $pestudios = '100';
}else if($valor5  == 'FUERZAS ARMADAS' ){ $pestudios = '100'; 
}else if($valor5  == 'INSTITUTO PROFESIONAL' ){ $pestudios = '80'; 
}else if($valor5  == 'CFT' ){ $pestudios = '70'; 
}else if($valor5  == 'ENSENANZA MEDIA' ){ $pestudios = '50'; 
}else{ $pestudios = '0'; }


	//$valorfinal = (0.6 * ((0.85 * $pnota) + (0.15 * $pestudios) )) + (0.4 * ((0.7 * $prenta) + (0.3 * $pgrupof)));
    $valorfinal = (0.55 * ((0.85 * $pnota) + (0.15 * $pestudios) )) + (0.45 * ((0.7 * $prenta) + (0.3 * $pgrupof)));

	echo $valor."|".$valor2."|".$valor3."|".$valor5."|".$valor5."||".$prenta."|".$pestudios."|".$pgrupof."|".$pnota."|".round($valorfinal,2);

 
}

     $result->close();
     $db->next_result();
	 $db->close();
?>