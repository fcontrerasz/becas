<?php include("../conexion/conecta.php");
header('Content-typ: content="text/html; charset=UTF-8');

$id = -1;
if(isset($_GET["l"])){
$id = $_GET["l"];
}

if($id=="") die("");

$paso = -1;
if(isset($_GET["p"])){
$paso = $_GET["p"];
}

if(isset($_GET["b"])){
$beca = $_GET["b"];
}

//$variables = explode("?", $_SERVER['REQUEST_URI']);
//print_r($variables[1]);

$query = "";

if($beca == "2"){
	$query = "select * from  PONDERACION_EDUCACION where IDPONDEDUCACION = ".$id;
}
if($beca == "1"){
	$query = "select * from  PONDERACION_VIVIENDA where IDPONDVIVIENDA = ".$id;
}
//echo $query;
$result = $db->query($query);

if($result){
    while ($row = $result->fetch_object()){
		if($paso == 1){
		    echo $row->OBS_PASO1;
			
		}else if($paso == 2){
		 echo $row->OBS_PASO2;
		    		
		}else if($paso == 3){
		 echo $row->OBS_PASO3;
			
		}else if($paso == 4){
		 echo $row->OBS_PASO4;
			
		}else if($paso == 5){
		 echo $row->OBS_PASO5;
		 

		}
		
    }
     $result->close();
     $db->next_result();
}
else echo($db->error);
$db->close();


 ?>