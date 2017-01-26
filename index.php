<?php
require_once "config/init.php";

var_dump($_POST);

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl = carrega_template_login_registro();

$tpl_main -> parse('exibe_paginas');
$tpl_main -> setVariable('exibe_paginas',$tpl->get());

if (!empty($_POST)) {
    if (isset($_POST['login']) && $_POST['login'] === "Entrar") {
        $errors = processa_login();
        if (!empty($errors)) {
            $tpl = carrega_mensagem_erro();
            $tpl->setVariable('mensagem_erros', mostra_erros($errors));
            $tpl_main -> parse('exibe_errors');
            $tpl_main -> setVariable('exibe_errors',$tpl->get());
        }else if (isset($_POST['registrar']) && $_POST['registrar'] === "Registrar"){
            echo "entrei aqui";
        }
    }
    
    


}

$tpl_main->show();

?>