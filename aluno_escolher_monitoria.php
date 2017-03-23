<?php
require_once "config/init.php";
protect_page();

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl_menu = carrega_menu_aluno();

$tpl_main -> setVariable('exibe_menus',$tpl_menu->get());

if (autoriza_inscricao()) {

    if (!inscricao_finalizada()) {
        
        $tpl_dados_monitoria = preenche_template_monitoria();

        $tpl_main -> setVariable('exibe_paginas',$tpl_dados_monitoria->get());

        if (!empty($_POST)) {
            
            $disciplinas_escolhidas = $_POST;
            $errors = valida_escolhas_aluno($disciplinas_escolhidas);

            if (!empty($errors)) {
                $tpl = carrega_mensagem_erro();
                $tpl->setVariable('mensagem_erros', mostra_erros($errors));
                $tpl_main -> parse('exibe_mensagens');
                $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
            }else{

                $id_user = $_SESSION['id_user'];
                $id_monitoria = $_SESSION['id_monitoria'];
                $errors = grava_escolhas_monitoria($id_user, $id_monitoria,$disciplinas_escolhidas);

                if (!empty($errors)) {
                    $tpl = carrega_mensagem_erro();
                    $tpl->setVariable('mensagem_erros', mostra_erros($errors));
                    $tpl_main -> parse('exibe_mensagens');
                    $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
                }else{

                    $errors = grava_monitor_convidado($id_user,$id_monitoria);

                    if (!empty($errors)) {
                        $tpl = carrega_mensagem_erro();
                        $tpl->setVariable('mensagem_erros', mostra_erros($errors));
                        $tpl_main -> parse('exibe_mensagens');
                        $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
                    }else{

                        $errors = finaliza_inscricao($id_user,$id_monitoria);

                        if (!empty($errors)) {
                            $tpl = carrega_mensagem_erro();
                            $tpl->setVariable('mensagem_erros', mostra_erros($errors));
                            $tpl_main -> parse('exibe_mensagens');
                            $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
                        }else{

                            $tpl = carrega_mensagem_sucesso();
                            $mensagem_sucesso = "Sua inscrição foi recebida corretamente em nosso sistema.";
                            $tpl->setVariable('mensagem_sucesso', $mensagem_sucesso);
                            $tpl_main -> parse('exibe_mensagens');
                            $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
                        }
                    }
                }
            }
        }
    }else{
        $errors[] = "Você já efetuou suas escolhas. Não é possível realizar nenhuma mudança.";
        $tpl = carrega_mensagem_erro();
        $tpl->setVariable('mensagem_erros', mostra_erros($errors));
        $tpl_main -> parse('exibe_mensagens');
        $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
    }
}else{
    $errors[] = "O período de inscrição para a monitoria do MAT já se encerrou. Tente novamente no próximo semestre.";
    $tpl = carrega_mensagem_erro();
    $tpl->setVariable('mensagem_erros', mostra_erros($errors));
    $tpl_main -> parse('exibe_mensagens');
    $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
}



$tpl_main->show();
?>