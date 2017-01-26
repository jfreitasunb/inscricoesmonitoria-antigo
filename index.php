<?php
require_once "config/init.php";

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
        }
    }else if (isset($_POST['registrar']) && $_POST['registrar'] === "Registrar"){
            $errors = valida_usuario_registrar();
            if (!empty($errors)) {
                $tpl = carrega_mensagem_erro();
                $tpl->setVariable('mensagem_erros', mostra_erros($errors));
                $tpl_main -> parse('exibe_errors');
                $tpl_main -> setVariable('exibe_errors',$tpl->get());
            }

                if (empty($errors)) {
                    $nome = htmlentities($_POST['nome'], ENT_QUOTES, "UTF-8");
                    $dados_usuario_novo = prepara_dados();
                    $errors = grava_usuario_novo($dados_usuario_novo);

                    if (empty($errors)) {
                        $validation_code = $dados_usuario_novo['validation_code'];
                        $email = $dados_usuario_novo['email'];

                        $resultado = envia_email_ativa_conta($nome,$email,$validation_code);

                        // if ($resultado) {
                        //     header('Location: processa_nova_conta.php?sucesso');
                        //     exit();
                        // }
                    }
                }
        }
}

$tpl_main->show();

?>