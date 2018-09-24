<?php include("../conexion/conecta.php"); 

function grab_dump($var)
{
    ob_start();
    var_dump($var);
    return ob_get_clean();
}

?>
<?php


require '../phpmailer/PHPMailerAutoload.php';
if(!isset($_SESSION)){
session_start();
}


if(!$_GET){
	echo "-2";
	die;
}

if($_SESSION["idusuario"] == null){
	echo "-3";
	die;
}

$variables = explode("?", $_SERVER['REQUEST_URI']);
parse_str($variables[1]);
$arr = get_defined_vars();

/*$mensaje2 = $_SESSION["idusuario"];
$data = $mensaje2.PHP_EOL;
$fp = fopen('logs_ingresos2.txt', 'a');
fwrite($fp, $data);*/
/*
if($_SESSION["idusuario"] == "75"){
	
	$email = new PHPMailer();
	$email->IsHTML(true); 
	$email->CharSet = 'UTF-8';
	$email->From      = 'autonomo@oticdelaconstruccion.cl';
	$email->FromName  = 'Login - Postulacion de Estudios';
	$email->Subject   = 'Te pillamos TOMAR REGISTRO';
	$email->Body      = $mensaje2." IDPOSTULACION = ".$i;
	$email->AddAddress( 'fcontrerasz@gmail.com' );
	if(!$email->send()) {
	    echo '<script>console.log("Mensaje Error: ' . $email->ErrorInfo.'");</script>';
	} else {
	    echo '<script>console.log("Mensaje: Enviado");</script>';
	}
}*/

$resultado = 0;




$query = "UPDATE POSTULACIONES_WEB SET IDEVALUADOR = ".$_SESSION["idusuario"]." WHERE IDPOSTULACION = ".$i;
//echo $query;
$result = $db->query($query);
//or die(mysqli_error($db));

$mensaje2 = grab_dump($_SESSION);
$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
        "Data: ".$mensaje2.PHP_EOL.
        "Query: ".$query.PHP_EOL.
        "-------------------------".PHP_EOL;
if(file_put_contents('log_tomar.txt', $log, FILE_APPEND)){

	//echo "Guardado Correctamente";
}

if($result){  
	$resultado = 1;
}
$db->next_result();


$db->close();
echo $resultado;
?>