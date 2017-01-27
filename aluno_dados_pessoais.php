<?php
require_once "config/init.php";
protect_page();

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl = carrega_dados_pessoais_aluno();

$tpl_main -> setVariable('exibe_menus',$tpl->get());

$tpl_main->show();
?>