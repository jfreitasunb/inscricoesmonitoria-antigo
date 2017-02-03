<?php
require_once "config/init.php";
protect_page();

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl_menu = carrega_menu_coordenador();

$tpl_main -> setVariable('exibe_menus',$tpl_menu->get());

$tpl_configura_monitoria = carrega_template_configura_monitoria();

$tpl_main -> setVariable('exibe_paginas',$tpl_configura_monitoria->get());

seleciona_disciplinas_para_monitoria();

if (!empty($_POST)) {
    
    $errors = valida_dados_configuracao();

    if (!empty($errors)) {
        $tpl = carrega_mensagem_erro();
        $tpl->setVariable('mensagem_erros', mostra_erros($errors));
        $tpl_main -> parse('exibe_mensagens');
        $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
    }else{
        $datas_inscricao  = array(
            'inicio_inscricao'  => $_POST['inicio_inscricao'],
            'fim_inscricao'     => $_POST['fim_inscricao'],
            'semestre'     => $_POST['semestre']
        );

        $datas_sanitizadas = sanitiza_dados_bancarios($datas_inscricao);

        $resultado = grava_datas_monitoria($datas_sanitizadas);

        if ($resultado) {
                $tpl = carrega_mensagem_sucesso();
                $mensagem_sucesso = "A inscrição foi configurada com sucesso.";
                $tpl->setVariable('mensagem_sucesso', $mensagem_sucesso);
                $tpl_main -> parse('exibe_mensagens');
                $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
            }else{
                $errors[] = "Houve um problema durante a configuração da monitoria. Tente novamente mais tarde.";
                $tpl = carrega_mensagem_erro();
                $tpl->setVariable('mensagem_erros', mostra_erros($errors));
                $tpl_main -> parse('exibe_mensagens');
                $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
            }
    }
}

$tpl_main->show();
?>