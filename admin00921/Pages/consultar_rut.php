<?php include("../conexion/conecta.php"); ?>
<?php
function validar($r){$s=1;for($m=0;$r!=0;$r/=10)$s=($s+$r%10*(9-$m++%6))%11;
return chr($s?$s+47:75);}

$rut = -1;
if(isset($_GET["rut"])){
$rut = $_GET["rut"];
}

$dv = -1;
if(isset($_GET["dv"])){
$dv = $_GET["dv"];
}

$ndv = validar($rut);

if($ndv != $dv){
	die("2");
}

$query = "SELECT IDPUNTO from MASTRO_LISTAR_BUSQUEDAS where NN_RUT = ".$rut;
$result = mssql_query($query);
$numRows = mssql_num_rows($result); 
mssql_close($cn_licitaciones);

if($numRows>0){
	die("1");
}else{
	die("0");
}
?>