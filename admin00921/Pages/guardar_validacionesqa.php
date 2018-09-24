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
  r1 = ".revisaSQL($r1, "int").",
  r2 = ".revisaSQL($r2, "int").",
  r3 = ".revisaSQL($r3, "int").",
  r4 = ".revisaSQL($r4, "int").",
  r5 = ".revisaSQL($r5, "int").",
  r6 = ".revisaSQL($r6, "int").",
  r7 = ".revisaSQL($r7, "int").",
  r8 = ".revisaSQL($r8, "int").",
  r9 = ".revisaSQL($r9, "int").",
  r10 = ".revisaSQL($r10, "int").",
  r11 = ".revisaSQL($r11, "int").",
  r12 = ".revisaSQL($r12, "int").",
  r13 = ".revisaSQL($r13, "int").",
  r14 = ".revisaSQL($r14, "int").",
  r15 = ".revisaSQL($r15, "int").",
  r16 = ".revisaSQL($r16, "int").",
  r17 = ".revisaSQL($r17, "int").",
  r18 = ".revisaSQL($r18, "int").",
  r19 = ".revisaSQL($r19, "int").",
  r20 = ".revisaSQL($r20, "int").",
  r21 = ".revisaSQL($r21, "int").",
  r22 = ".revisaSQL($r22, "int").",
  r23 = ".revisaSQL($r23, "int").",
  r24 = ".revisaSQL($r24, "int").",
  r25 = ".revisaSQL($r25, "int").",
  r26 = ".revisaSQL($r26, "int").",
  r27 = ".revisaSQL($r27, "int").",
  r28 = ".revisaSQL($r28, "int").",
  r29 = ".revisaSQL($r29, "int").",
  r30 = ".revisaSQL($r30, "int").",
  r31 = ".revisaSQL($r31, "int").",
  r32 = ".revisaSQL($r32, "int").",
  tr1 = ".revisaSQL($tr1, "text").",
  tr2 = ".revisaSQL($tr2, "text").",
  tr3 = ".revisaSQL($tr3, "text").",
  tr4 = ".revisaSQL($tr4, "text").",
  tr5 = ".revisaSQL($tr5, "text").",
  tr6 = ".revisaSQL($tr6, "text").",
  tr7 = ".revisaSQL($tr7, "text").",
  tr8 = ".revisaSQL($tr8, "text").",
  tr9 = ".revisaSQL($tr9, "text").",
  tr10 = ".revisaSQL($tr10, "text").",
  tr11 = ".revisaSQL($tr11, "text").",
  tr12 = ".revisaSQL($tr12, "text").",
  tr13 = ".revisaSQL($tr13, "text").",
  tr14 = ".revisaSQL($tr14, "text").",
  tr15 = ".revisaSQL($tr15, "text").",
  tr16 = ".revisaSQL($tr16, "text").",
  tr17 = ".revisaSQL($tr17, "text").",
  tr18 = ".revisaSQL($tr18, "text").",
  tr19 = ".revisaSQL($tr19, "text").",
  tr20 = ".revisaSQL($tr20, "text").",
  tr21 = ".revisaSQL($tr21, "text").",
  tr22 = ".revisaSQL($tr22, "text").",
  tr23 = ".revisaSQL($tr23, "text").",
  tr24 = ".revisaSQL($tr24, "text").",
  tr25 = ".revisaSQL($tr25, "text").",
  tr26 = ".revisaSQL($tr26, "text").",
  tr27 = ".revisaSQL($tr27, "text").",
  tr28 = ".revisaSQL($tr28, "text").",
  tr29 = ".revisaSQL($tr29, "text").",
  tr30 = ".revisaSQL($tr30, "text").",
  tr31 = ".revisaSQL($tr31, "text").",
  tr32 = ".revisaSQL($tr32, "text")."
WHERE
  IDPONDEDUCACION = ".revisaSQL($l, "int");

$result = $db->query($query);
if($result){
echo "1";
}else{echo "0";}
$db->next_result();
?>