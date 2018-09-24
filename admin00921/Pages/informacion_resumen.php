<?php include("../conexion/conecta.php"); ?>
<?php
if(!isset($_GET["i"])) die("-1");

$query = "select * from listar_resumen_basico WHERE IDPOSTULACION = ".$_GET["i"];

//die($query);

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows>0){

$row = $result->fetch_object();
$nombretitular =$row->NOMBRETRABAJADOR;
$estadopostulacion =$row->ESTADO_BECA;

}

$result->close();
$db->next_result();
$db->close();

?>
<fieldset>
                    		<H2 style="width:650px;">NOMBRE TITULAR (ID:<?php echo $_GET["i"]; ?>): <?php echo $nombretitular; ?></H2>
                            <span class="texto-titu2">ESTADO:  <a href='#' class='inline-link-g0'><?php echo $estadopostulacion; ?></a></span><br />
               </fieldset>
<fieldset>
         			<div style="float:left"><label>CAMBIAR ESTADO POSTULACION</label>
                           <select id="epaso1" name="epaso1" class="text-observaciones">
                        		 <option value="0">-</option>
                                 <?php if($_SESSION["idusuario"]=="26"){ ?>
                                  <option value="1">EN CURSO</option>
                                 <?php } ?>
                                <option value="3">CON OBSERVACIONES</option>
                                <option value="10">POSTULADA CORRECTAMENTE</option>
                                <option value="5">RECHAZADA</option>
                                <option value="7">EN AUDITORIA</option>
                           </select>
                          
                    </div>
                    
         </fieldset>
         

         
                <!--<fieldset>
        					<H2 style="width:650px;">BITACORA DE CAMBIOS</H2>
<div style="height:20px" class="clear"></div>
                    <table id="sort02" class="rounded-corner" style="width:100%;padding: 0; margin:0;">
                    <thead>
                    <tr>     	
                        <td style="background-color:#E6F1F5; font-weight:bold;">FECHA</td>
                        <td style="background-color:#E6F1F5; font-weight:bold;">ESTADO</td>
                        <td style="background-color:#E6F1F5; font-weight:bold;">ACCION</td>
                        <td style="background-color:#E6F1F5; font-weight:bold;">AUDITOR</td>
                    </tr>
                    </thead>
                    <tbody>
                    
                    <tr>
                        <td><?php echo date("d/m/Y H:i:s",strtotime('2015-1-1')); ?></td>     	
                        <td>2</td>
                        <td style="font-size:11px;"><span class="xnivel1"><?php echo "TIPO</span> -> <span class='xnivel2'>SUBTIPO</span> -> <span class='xnivel3'>DETALLE<span> -> <span class='xnivel4'>RESOLUCION"; ?></span></td>
                        <td><?php echo "1" ?></td>
                    </tr>
                    </tbody>
                    </table>
                            
             </fieldset>-->


<?

 

?>