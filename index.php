<?php
require_once "config/init.php";

if (!empty($_POST)) {
    processa_login();
}

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl = carrega_template_login_registro();

$tpl_main -> parse('exibe_paginas');
$tpl_main -> setVariable('exibe_paginas',$tpl->get());

$tpl_main->show();

?>