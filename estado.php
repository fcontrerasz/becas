<?php require_once('admin00921/conexion/conecta.php'); ?>
<?php 
header('Content-Type: text/html; charset=ISO-8859-1');
header('Content-Type: text/html; charset=ISO-8859-1');

if(!isset($_GET["r"])) die("-1");
//if(!isset($_GET["d"])) die("-1");
$r = $_GET["r"];
//$d = $_GET["d"];
$e = 0;
$n = "RUT NO ENCONTRADO";
//die();

$query = "SELECT * FROM Adjudicados_Becas_VP_2017 WHERE RUT like '%".$r."%' ";
$result = $db->query($query);
//echo $query;


?>
<link href="css/style.default.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>
<style>
.label {
-moz-border-radius: 0;
-webkit-border-radius: 0;
border-radius: 0;
font-size: 13px;
text-shadow: none;
font-weight: normal;
text-transform: uppercase;
padding: 2px 5px;
}

.label-success{
background-color: #bedd5c;
}

.label-info{
background-color: #f7a30a;
}

.ui-accordion .ui-accordion-header {
background-color: #f3f3f3 !important;
border: 0;
padding:15px !important;
margin: 0px;
border: 1px solid #FCB904 !important;
}
.ui-accordion-header {
font-size: 12px;
text-shadow: 1px 1px rgba(255,255,255,0.3);
cursor: pointer;
margin-top: 10px !important;
}
.ui-accordion-content {
padding: 10px !important;
border-left: 1px solid #FCB904 !important;
border-right: 1px solid #FCB904 !important;
border-bottom: 1px solid #FCB904 !important;
color: #666 !important;
overflow: hidden !important;
background: #fff !important;
}
.filtro{
font-family: 'Lato', verdana !important;
font-size: 12px !important;
background-color: #f7a30a;
padding:5px;
cursor: pointer;
color: white;
}
.todas{
font-family: 'Lato', verdana !important;
font-size: 12px !important;
background-color: #784e27;
padding:5px;
cursor: pointer;
}
a, a:hover, a:link, a:active, a:focus {
outline: none;
color: white !important;
text-decoration: none;
}

.data_web{
font-size:12px;
}


</style>
<?php

if($result->num_rows>0){
while ($row = $result->fetch_object()){
//	$row = $result->fetch_object();
	
//var_dump($result);
//die("2");
	$n = $row->OBSERVACION_ADJ;
	$e = $row->RUT_POST;
	//$row->IDESTADOBECA;
	$rutpost = $r;
	$o = $row->GLOSA_ADJ;
	
?>
<h2 class="data_web"><strong>RUT:</strong> <?php echo $e; ?></h2>
<h2 class="data_web"><strong>ESTADO:</strong> <?php echo $n; ?></h2>
<h2 class="data_web"><strong>OBSERVACION:</strong> <?php echo $o; ?></h2>
<hr />
<?php
	}
     $result->close();
     $db->next_result();
}
$db->close();
?>
