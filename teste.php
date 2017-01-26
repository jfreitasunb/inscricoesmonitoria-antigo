<?php
require_once "config/init.php";

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl = carrega_mensagem_sucesso();

$tpl_main -> parse('exibe_paginas');
$tpl_main -> setVariable('exibe_paginas',$tpl->get());

$tpl_main->show();
?>