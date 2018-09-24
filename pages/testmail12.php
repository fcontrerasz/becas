<?php
//require 'phpmailer/PHPMailerAutoload.php';

$query = "SELECT * from listar_resumen_basico where IDPOSTULACION = ".revisaSQL($_GET["id"], "int");
$result = $db->query($query);
if($result->num_rows == "0"){
	die("-1");
}

if($result->num_rows>0){
	$row = $result->fetch_object();
	$g[] = $row;
}else{ echo "|0"; }
$result->close();
$db->next_result();

$db->close();


$bodytext = "Gracias por Postular ".$g[0]->NOMBRETRABAJADOR."(".$g[0]->RUTEMPLEADO.")\n Los datos de tu postulacion son los Siguientes: \n Empresa: ".$g[0]->RUTEMPRESA." \n RAZON: ".$g[0]->RAZONSOCIAL."\n OTROS CAMPOS POR AGREGAR......";
$bodytext = wordwrap($bodytext,70);

$email = new PHPMailer();
//$mail->SMTPDebug = 3;   


$email->From      = 'soporte@studianet.cl';
$email->FromName  = 'Becas Codelco';
$email->Subject   = 'Confirmacion de Postulacion';
$email->Body      = $bodytext;
$email->AddAddress( $g[0]->CORREO_TRABAJADOR );
/*
$file_to_attach = 'tmp/demo.txt';
$email->AddAttachment( $file_to_attach , 'demo.txt' );
*/
if(!$email->send()) {
    echo '|Mensaje Error: ' . $email->ErrorInfo;
} else {
    echo '|Mensaje Enviado';
}
/*
$msg = "First line of text\nSecond line of text";
$msg = wordwrap($msg,70);
mail("fcontrerasz@gmail.com","Bienvenido",$msg);
*/

?>