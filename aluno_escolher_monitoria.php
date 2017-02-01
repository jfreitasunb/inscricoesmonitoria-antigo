<?php
require_once "config/init.php";
protect_page();

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl_menu = carrega_menu_aluno();

$tpl_main -> setVariable('exibe_menus',$tpl_menu->get());


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
        $id_candidato = $_SESSION['id_user'];
        $id_monitoria_ativa = $_SESSION['id_monitoria_ativa'];
        $resultado = grava_escolhas_monitoria($id_candidato, $id_monitoria_ativa,$disciplinas_escolhidas);

        if ($resultado) {
                $tpl = carrega_mensagem_sucesso();
                $mensagem_sucesso = "Seus escolhas para monitoria foram gravadas em nosso sitemas.";
                $tpl->setVariable('mensagem_sucesso', $mensagem_sucesso);
                $tpl_main -> parse('exibe_mensagens');
                $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
                $errors = upload_historico($id_candidato);

                if (!empty($errors)) {
                    $tpl = carrega_mensagem_erro();
                    $tpl->setVariable('mensagem_erros', mostra_erros($errors));
                    $tpl_main -> parse('exibe_mensagens');
                    $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
                }else{
                    $errors = finaliza_escolhas($id_candidato,$id_monitoria_ativa,$disciplinas_escolhidas);
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

$tpl_main->show();
?>