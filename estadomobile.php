<link href="css/style.default.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>
<style>
.label {
-moz-border-radius: 0;
-webkit-border-radius: 0;
border-radius: 0;
font-size: 15px !important;
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
font-size: 15px !important;
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
font-size: 15px !important;
background-color: #784e27;
padding:5px;
cursor: pointer;
}
a, a:hover, a:link, a:active, a:focus {
outline: none;
color: white !important;
text-decoration: none;
}

.mensajeestados {
font-size: 13px;
padding: 3px;
margin: 5px;
margin-left: 0px;
padding-left: 3px;
background-color: #b92c34;
color: white;
}


</style>
<h2>RUT CONSULTADO: <?php echo $_GET["r"]."-".$_GET["d"]; ?></h2>

<h2>TU ESTADO ES : PENDIENTE</h2>

<div id="accordion" class="ui-accordion ui-widget ui-helper-reset .accordion-warning">

    <h3 class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
        <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>
        Paso 1: Informacion Personal  <label class="label label-success">Correcto</label><img src="img/ok.png" width="25" height="25" border="0" align="left"  /> 
    </h3>
    <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style="display:none; visible: true;">
        <p>
            Sin Observaciones.
        </p>
    </div>
    <h3 class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all bad">
        <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>
        Paso 2: Antecedentes Empleador  <label class="label label-info">Observaciones</label><img src="img/observa-small.png" width="25" height="25" border="0" align="left"  /> 
    </h3>
     <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
        <p>
            Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
            ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
            amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
            odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
        </p>
    </div>
        <h3 class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
        <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>
        Paso 3: Antecedentes de la Vivienda  <label class="label label-info">Observaciones</label><img src="img/observa-small.png" width="25" height="25" border="0" align="left"  /> 
    </h3>
     <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
		<p>
            Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
            ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
            amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
            odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
        </p>
    </div>
	<h3 class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
        <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>
        Paso 4: Declaracion Jurada  <label class="label label-success">Correcto</label><img src="img/ok.png" width="25" height="25" border="0" align="left"  /> 
    </h3>
     <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
        <p>
            Sin Observaciones.
        </p>
    </div>
	<h3 class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
        <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>
        Paso 5: Documentacion  <label class="label label-success">Correcto</label><img src="img/ok.png" width="25" height="25" border="0" align="left"  /> 
    </h3>
     <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
        <p>
            Sin Observaciones.
        </p>
    </div>
</div>
<div class="mensajeestados">
    <center>Para corregir las observaciones, debes hacerlo desde un computador</center>
</div>

<script type="text/javascript">
var headers = $('#accordion .accordion-header');
var contentAreas = $('#accordion .ui-accordion-content ').hide();
var expandLink = $('.accordion-expand-all');
var observLink = $('.accordion-observ-all');


// add the accordion functionality
headers.click(function() {
    var panel = $(this).next();
    var isOpen = panel.is(':visible');
 
    // open or close as necessary
    panel[isOpen? 'slideUp': 'slideDown']()
        // trigger the correct custom event
        .trigger(isOpen? 'hide': 'show');

    // stop the link from causing a pagescroll
    return false;
});

// when panels open or close, check to see if they're all open
contentAreas.on({
    // whenever we open a panel, check to see if they're all open
    // if all open, swap the button to collapser
    show: function(){
        var isAllOpen = !contentAreas.is(':hidden');   
        if(isAllOpen){
            expandLink.text('Contraer Todas')
                .data('isAllOpen', true);
        }
    },
    // whenever we close a panel, check to see if they're all open
    // if not all open, swap the button to expander
    hide: function(){
        var isAllOpen = !contentAreas.is(':hidden');
        if(!isAllOpen){
            expandLink.text('Ver Todas')
            .data('isAllOpen', false);
        } 
    }
});


$('#accordion .bad').each(function(){ 
	$(this).trigger("click");
});


</script>