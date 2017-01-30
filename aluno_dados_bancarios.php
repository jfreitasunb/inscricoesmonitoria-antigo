<?php
require_once "config/init.php";
protect_page();

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl_menu = carrega_menu_aluno();

$tpl_main -> setVariable('exibe_menus',$tpl_menu->get());


$tpl_dados_bancarios = carrega_dados_bancarios();

$tpl_main -> setVariable('exibe_paginas',$tpl_dados_bancarios->get());

$tpl_main->show();


$errors = valida_dados_bancarios();

$dados_bancarios  = array(
    'nomebanco'            => $_POST['nomebanco'],
    'numerobanco'          => $_POST['numerobanco'], 
    'agenciabancaria'      => $_POST['agenciabancaria'], 
    'nomerocontacorrente'  => $_POST['nomerocontacorrente']
    );

$dados_bancarios_sanitizados = sanitiza_dados_bancarios($dados_bancarios);

grava_dados_bancarios_usuario($_SESSION['id_user'],$dados_bancarios_sanitizados);
?>