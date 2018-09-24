<?php include("../conexion/conecta.php"); ?>
<?php 
$cod = explode("?", $_SERVER['REQUEST_URI']);
parse_str($cod[1]);
//var_dump($cod[1]);
$arr = get_defined_vars();
//var_dump($arr);

$query = @"UPDATE
  PONDERACION_EDUCACION
SET
  ponderacion = ".revisaSQL($n, "text").",
  fecha_mod = NOW() 
WHERE
  IDPONDEDUCACION = ".revisaSQL($l, "int");

$result = $db->query($query);
if($result){
echo "1";
}else{echo "0";}
$db->next_result();
?>