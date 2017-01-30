<?php
require_once "config/init.php";
protect_page();

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl_menu = carrega_menu_aluno();

$tpl_main -> setVariable('exibe_menus',$tpl_menu->get());


$tpl_dados_monitoria = preenche_template_monitoria();

$tpl_main -> setVariable('exibe_paginas',$tpl_dados_monitoria->get());

$tpl_main->show();



$disciplinas_escolhidas = $_POST;
$errors = valida_escolhas_aluno($disciplinas_escolhidas);
$id_candidato = $_SESSION['id_user'];
$ano_monitoria = '2017';
$semestre_monitoria = '1';

if (empty($errors)){
    $resultado = grava_escolhas_monitoria($id_candidato, $ano_monitoria, $semestre_monitoria,$disciplinas_escolhidas);
    
    if (in_array(0, $resultado)) {
        $errors[] = "Houve um erro na hora de gravar suas escolhas. Tente novamente mais tarde.";
    }else{
        $errors = upload_historico($id_candidato);
        if (empty($errors)) {
            $errors = finaliza_escolhas($id_candidato, $ano_monitoria, $semestre_monitoria,$disciplinas_escolhidas);
        }
    }
}
?>