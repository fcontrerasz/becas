<?php include("conexion/conecta.php"); ?>
<?php
//die("1");
//if(!isset($_GET["i"])) die("-1");

function truncateFloat($number, $digitos)
{
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos);
 
}

function traeNota($id){
global $db;
$query = "select * from listar_datos_ponderacion_estudios WHERE IDPOSTULACION = ".$id;
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

$prenta = $valor;

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


$valorfinal = (0.55 * ((0.85 * $pnota) + (0.15 * $pestudios) )) + (0.45 * ((0.7 * $prenta) + (0.3 * $pgrupof)));

//echo $valor."|".$valor2."|".$valor3."|".$valor5."|".$valor5."||".$prenta."|".$pestudios."|".$pgrupof."|".$pnota."|".round($valorfinal,2);

 
return round($valorfinal,2);

} }

$result = $db->query("select * from listar_masivo_ponderacion");
if($result){  
while ($row = $result->fetch_object()){
// echo $row->IDPOSTULACION." - ".traeNota($row->IDPOSTULACION)."/".$row->IDPONDEDUCACION."<br>";
 if($row->IDPONDEDUCACION <> ""){
 echo "UPDATE PONDERACION_EDUCACION set ponderacion = '".traeNota($row->IDPOSTULACION)."' where IDPONDEDUCACION = ".$row->IDPONDEDUCACION."; <br>";
 }
}}

$db->close();

?>