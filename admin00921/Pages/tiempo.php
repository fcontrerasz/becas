<?php
session_start();
$now = time(); 
if($now > $_SESSION['expire'])
{
	session_destroy();
	echo "1";
}else{
	echo date('i:s', $_SESSION['expire']-time());
}
?>