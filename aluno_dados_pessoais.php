<?php
require_once "config/init.php";
protect_page();

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl_menu = carrega_menu_aluno();

$tpl_main -> setVariable('exibe_menus',$tpl_menu->get());


$tpl_dados_pessoais = carrega_dados_pessoais_aluno();

$tpl_main -> setVariable('exibe_paginas',$tpl_dados_pessoais->get());

$tpl_main->show();

var_dump($_POST);
var_dump($_SESSION);

$errors = valida_dados_pessoais();

print_r($errors);
?>