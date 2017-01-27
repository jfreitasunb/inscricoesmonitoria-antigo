<?php
require_once "config/init.php";

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");


$tpl_main->show();
echo "<meta HTTP-EQUIV='Refresh' CONTENT='5;URL=index.php'>";
?>