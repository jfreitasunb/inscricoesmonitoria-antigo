<?php
require_once "config/init.php";
protect_page();

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl_menu = carrega_menu_aluno();

$tpl_main -> setVariable('exibe_menus',$tpl_menu->get());

if (!inscricao_finalizada()) {
    
    $tpl_dados_bancarios = carrega_template_dados_academicos();

    $tpl_main -> setVariable('exibe_paginas',$tpl_dados_bancarios->get());

    $id_user = $_SESSION['id_user'];
    $id_monitoria = $_SESSION['id_monitoria'];

    if (!empty($_POST)) {

        $atuou_monitoria = $_POST['checkbox_foi_monitor'];
        
        $dados_academicos = array(
            'ira'               => $ira = str_replace(',', '.', $_POST['ira']),
            'curso_graduacao'   => $_POST['curso_graduacao']);

        $errors = valida_dados_academicos();

        if (!empty($errors)) {
            $tpl = carrega_mensagem_erro();
            $tpl->setVariable('mensagem_erros', mostra_erros($errors));
            $tpl_main -> parse('exibe_mensagens');
            $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
        }else{
            $dados_academicos_sanitizados = sanitiza_dados($dados_academicos);

            $tabela = "dados_academicos";

            $errors = grava_dados_pessoais_usuario($id_user,$id_monitoria,$dados_academicos_sanitizados,$tabela);

            if (empty($errors)) {

                    $errors = grava_atuacao_anterior($id_user,$atuou_monitoria);

                    if (!empty($errors)) {
                        $tpl = carrega_mensagem_erro();
                        $tpl->setVariable('mensagem_erros', mostra_erros($errors));
                        $tpl_main -> parse('exibe_mensagens');
                        $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
                    }else{
                        
                        $errors = upload_historico($id_user);
                        
                        if (!empty($errors)) {
                            $tpl = carrega_mensagem_erro();
                            $tpl->setVariable('mensagem_erros', mostra_erros($errors));
                            $tpl_main -> parse('exibe_mensagens');
                            $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
                        }else{
                            // $http = new HTTP2();
                            // $http->redirect("aluno_escolher_monitoria.php");
                            // 
                            $tpl = carrega_mensagem_sucesso();
                            $mensagem_sucesso = "Seus dados acadêmicos foram atualizados em nosso sitemas. Em breve você será redirecionando para a próxima etapa da inscrição.";
                            $tpl->setVariable('mensagem_sucesso', $mensagem_sucesso);
                            $tpl_main -> parse('exibe_mensagens');
                            $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
                            echo "<meta HTTP-EQUIV='Refresh' CONTENT='5;URL=aluno_escolher_monitoria.php'>";
                        }
                    }
                }else{
                    $errors[] = "Houve um problema durante a atualização dos seus dados. Tente novamente mais tarde.";
                    $tpl = carrega_mensagem_erro();
                    $tpl->setVariable('mensagem_erros', mostra_erros($errors));
                    $tpl_main -> parse('exibe_mensagens');
                    $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
                }
        }
    }
}else{
    $errors[] = "Você já finalizou sua inscrição. Não é possível realizar nenhuma mudança.";
    $tpl = carrega_mensagem_erro();
    $tpl->setVariable('mensagem_erros', mostra_erros($errors));
    $tpl_main -> parse('exibe_mensagens');
    $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
}

$tpl_main->show();
?>