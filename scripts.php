<!--
This site is protected by WP-CopyRightPro
Copyright 2010  Wp-CopyRightPro, IN  (http://wp-copyrightpro.com/)
-->

<!-- EVITAR CLICK DERECHO-->
<?php if (copyrightpro_consulta('copy_click') == 'y'){?>
<script language="Javascript">
<!-- Begin
document.oncontextmenu = function(){return false}
// End -->
</script>
<?PHP }?>

<!-- SELECCION DE TEXTO-->
<?php if (copyrightpro_consulta('copy_selection') == 'y'){ ?>
<script type="text/javascript">
// IE Evitar seleccion de texto
document.onselectstart=function(){
if (event.srcElement.type != "text" && event.srcElement.type != "textarea" && event.srcElement.type != "password")
return false
else return true;
};

// FIREFOX Evitar seleccion de texto
if (window.sidebar){
document.onmousedown=function(e){
var obj=e.target;
if (obj.tagName.toUpperCase() == "INPUT" || obj.tagName.toUpperCase() == "TEXTAREA" || obj.tagName.toUpperCase() == "PASSWORD")
return true;
/*else if (obj.tagName=="BUTTON"){
return true;
}*/
else
return false;
}
}
// End -->
</script>
<?php }?>


<!-- EVITAR IFRAME-->
<?php if (copyrightpro_consulta('copy_iframe') == 'y'){ ?>
<script type="text/javascript" language="JavaScript1.1">
<!--// evito que se cargue en otro frame
if (parent.frames.length > 0) top.location.replace(document.location);
//-->
</script>
<?php }?>


<!-- EVITAR DRAG AND DROP-->
<?php if (copyrightpro_consulta('copy_drop') == 'y'){ ?>
<script language="Javascript">
<!--// Begin
document.ondragstart = function(){return false}
//-->
</script>
<?php }?>