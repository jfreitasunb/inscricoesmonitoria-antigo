<?php
require_once "config/init.php";

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$dados_monitoria = retorna_monitoria_ativa();

if (!empty($dados_monitoria)) {
    $data_inicio = DateTime::createFromFormat('Y-m-d', $dados_monitoria['inicio_inscricao']);
    $data_fim = DateTime::createFromFormat('Y-m-d', $dados_monitoria['fim_inscricao']);

    $tpl_main->loadTemplatefile("cabecalho_rodape.tpl");
    $tpl_main->setVariable('periodo_inscricao',$data_inicio->format('d/m/Y')." à ".$data_fim->format('d/m/Y'));    
}else{
    $tpl_main->loadTemplatefile("cabecalho_rodape.tpl");
$tpl_main->setVariable('periodo_inscricao','O período de inscrição já se encerrou ou ainda não está aberto');
}

$formulario_ativo = "class=\"active\"";
$tipo_estilo_none = "style=\"display: none;\"";
$tipo_estilo_block = "style=\"display: block;\"";

$tpl = carrega_template_login_registro();
$tpl->setVariable('ativa_formulario_login',$formulario_ativo);
$tpl->setVariable('ativa_formulario_registro','');
$tpl->setVariable('tipo_estilo_login',$tipo_estilo_block);
$tpl->setVariable('tipo_estilo_registro',$tipo_estilo_none);
$tpl_main -> parse('exibe_paginas');
$tpl_main -> setVariable('exibe_paginas',$tpl->get());

if (!empty($_POST)) {
    if (isset($_POST['login']) && $_POST['login'] === "Entrar") {
        $errors = processa_login();
        if (!empty($errors)) {

            $tpl = carrega_mensagem_erro();
            $tpl->setVariable('mensagem_erros', mostra_erros($errors));
            $tpl_main -> parse('exibe_mensagens');
            $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
        }
    }else if (isset($_POST['registrar']) && $_POST['registrar'] === "Registrar"){
            $errors = valida_usuario_registrar();
            if (!empty($errors)) {
                $tpl_main->clearVariables();
                $tpl = carrega_template_login_registro();
                $tpl->clearVariables();
                $tpl->setVariable('ativa_formulario_login','');
                $tpl->setVariable('ativa_formulario_registro',$formulario_ativo);
                $tpl->setVariable('tipo_estilo_login',$tipo_estilo_none);
                $tpl->setVariable('tipo_estilo_registro',$tipo_estilo_block);
                $tpl_main -> parse('exibe_paginas');
                $tpl_main -> setVariable('exibe_paginas',$tpl->get());
                $tpl_erro = carrega_mensagem_erro();
                $tpl_erro->setVariable('mensagem_erros', mostra_erros($errors));
                $tpl_main -> parse('exibe_mensagens');
                $tpl_main -> setVariable('exibe_mensagens',$tpl_erro->get());
            }

                if (empty($errors)) {
                    $nome = sanitize($_POST['nome']);
                    $dados_usuario_novo = prepara_dados();
                    $errors = grava_usuario_novo($dados_usuario_novo);
                    $id_user = retorna_id_user_from_username($dados_usuario_novo['login']);
                    if (empty($errors)) {
                        grava_dados_basicos_usuario($id_user,$nome);    
                    }
                    
                    if (empty($errors)) {
                        $validation_code = $dados_usuario_novo['validation_code'];
                        $email = $dados_usuario_novo['email'];

                        $resultado = envia_email_ativa_conta($nome,$email,$validation_code);

                        if ($resultado) {
                            $tpl = carrega_mensagem_sucesso();
                            $mensagem_sucesso = "Sua conta foi criada em nosso sistema. Um e-mail com um link de ativação foi enviado. Somente após ativar sua conta você poderá fazer login.";
                            $tpl->setVariable('mensagem_sucesso', $mensagem_sucesso);
                            $tpl_main -> parse('exibe_mensagens');
                            $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
                        }
                    }
                }
        }
}

$tpl_main->show();

?>