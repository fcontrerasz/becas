<?php include("../conexion/conecta.php"); ?>
<?php
error_reporting(-1);
session_start();


//var_dump($_GET);
if(!$_GET){
	echo "-2";
	die;
}
if($_SESSION["idusuario"] == null){
	echo "-3";
}
$id = $_GET["tb_id"];
$usr = $_GET["tb_usuario"];
$gestiones = $_GET["tb_correlativo"];
$tipo = "";
$reclamo = "";
$operacional = "";
$comercial  = "";
$deriva = "";
$otro = "";
$otrorecla = "";
$idllamada = "";
$nivel = "";
$otros = "";

if(isset($_GET["idllamada"])){
$idllamada = $_GET["idllamada"];
}

if(isset($_GET["sol_gral"])){
$tipo = $_GET["sol_gral"];
}

if(isset($_GET["t_recla"])){
$reclamo = $_GET["t_recla"];
}

//version original
//if(isset($_GET["sol_op"])){
//$operacional = $_GET["sol_op"];
//}

//version 4
if(isset($_GET["elem_oper"])){
$operacional = $_GET["elem_oper"];
}

//if(isset($_GET["sol_com"])){
//$comercial = $_GET["sol_com"];
//}

if(isset($_GET["elem_comer"])){
$comercial = $_GET["elem_comer"];
}



//if(isset($_GET["sol_tec"])){
//$tecnologia = $_GET["sol_tec"];
//}


if(isset($_GET["elem_tec"])){
$tecnologia = $_GET["elem_tec"];
}


if(isset($_GET["deriva"])){
$deriva_otro = $_GET["deriva"];
}



if(isset($_GET["elem_nivel"])){
$deriva_nivel = $_GET["elem_nivel"];
}


$deriva = $deriva_otro.",".$deriva_nivel;



if( $deriva == "0," ){
$deriva = "";	
} 



if(isset($_GET["otro"])){
$otro = $_GET["otro"];
}

if(isset($_GET["otroreclamo"])){
$otrorecla = $_GET["otroreclamo"];
}


$g1 = "0";
$g2 = "0";
$g3 = "0";
$g4 = "0";
$g5 = "0";
$g6 = "0";
$g7 = "0";
$g8 = "0";
$g9 = "0";
$g10 = "0";
$g11 = "0";
$g12 = "0";



//valida si vienen los ckeck enable y deja en la variable g un 1
	



if(isset($_GET["colg_1"])) $g1 = 1;
if(isset($_GET["colg_2"])) $g2 = 1;
if(isset($_GET["colg_3"])) $g3 = 1;
if(isset($_GET["colg_4"])) $g4 = 1;
if(isset($_GET["colg_5"])) $g5 = 1;
if( (isset($_GET["niveluno"])) || (isset($_GET["colg_6"])) ){
$g6 = 1;	
} 
if(isset($_GET["colg_7"])) $g7 = 1;
if(isset($_GET["colg_8"])) $g8 = 1;
if(isset($_GET["colg_9"])) $g9 = 1;
if(isset($_GET["colg_10"])) $g10 = 1;
if(isset($_GET["colg_11"])) $g11 = 1;
if(isset($_GET["colg_12"])) $g12 = 1;


$resultado = 0;

$proc = mssql_init("insert_colgar",$cn_licitaciones);
mssql_bind($proc,"@idcliente",$id,SQLVARCHAR,false, false);
mssql_bind($proc,"@usuario",$usr,SQLVARCHAR,false, false);
mssql_bind($proc,"@g1",$g1,SQLVARCHAR,false, false);
mssql_bind($proc,"@g2",$g2,SQLVARCHAR,false, false);
mssql_bind($proc,"@g3",$g3,SQLVARCHAR,false, false);
mssql_bind($proc,"@g4",$g4,SQLVARCHAR,false, false);
mssql_bind($proc,"@g5",$g5,SQLVARCHAR,false, false);
mssql_bind($proc,"@g6",$g6,SQLVARCHAR,false, false);
mssql_bind($proc,"@g7",$g7,SQLVARCHAR,false, false);
mssql_bind($proc,"@g8",$g8,SQLVARCHAR,false, false);
mssql_bind($proc,"@g9",$g9,SQLVARCHAR,false, false);
mssql_bind($proc,"@g10",$g10,SQLVARCHAR,false, false);
mssql_bind($proc,"@g11",$g11,SQLVARCHAR,false, false);
mssql_bind($proc,"@g12",$g12,SQLVARCHAR,false, false);
mssql_bind($proc,"@tipogeneral",$tipo,SQLVARCHAR,false, false);
mssql_bind($proc,"@tipocomercial",$comercial,SQLVARCHAR,false, false);
mssql_bind($proc,"@tiporeclamo",$reclamo,SQLVARCHAR,false, false);
mssql_bind($proc,"@tipotecno",$tecnologia,SQLVARCHAR,false, false);
mssql_bind($proc,"@tipoopera",$operacional,SQLVARCHAR,false, false);
mssql_bind($proc,"@tipoderiva",$deriva,SQLVARCHAR,false, false);
mssql_bind($proc,"@otroderiva",$otro,SQLVARCHAR,false, false);
mssql_bind($proc,"@otroreclamo",$otrorecla,SQLVARCHAR,false, false);
mssql_bind($proc,"@idllamada",$idllamada,SQLVARCHAR,false, false);
mssql_bind($proc,"@result", $resultado, SQLVARCHAR, true, false, 20);
$data = mssql_execute($proc,true) or die("Fallo");
mssql_free_statement($proc);

if($resultado>1){
	$registros = explode(",", $gestiones);
	foreach($registros as $data => $value){  
        if($value!=""){
			$proc = mssql_init("insert_dinamico",$cn_licitaciones);
			mssql_bind($proc,"@idtab",$resultado,SQLVARCHAR,false, false);
			mssql_bind($proc,"@idges",$value,SQLVARCHAR,false, false);
			mssql_bind($proc,"@result",$resultado2, SQLVARCHAR, true, false, 20);
			$data = mssql_execute($proc,true) or die("Fallo");
			mssql_free_statement($proc);
		}
    } 

}

echo $resultado;
?>