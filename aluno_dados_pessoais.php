<?php
require_once "config/init.php";
protect_page();

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl_menu = carrega_menu_aluno();

$tpl_main -> setVariable('exibe_menus',$tpl_menu->get());


$tpl_dados_pessoais = carrega_dados_pessoais_aluno();

$tpl_main -> setVariable('exibe_paginas',$tpl_dados_pessoais->get());




if (!empty($_POST)) {
    $errors = valida_dados_pessoais();
    if (!empty($errors)) {    
        $tpl = carrega_mensagem_erro();
        $tpl->setVariable('mensagem_erros', mostra_erros($errors));
        $tpl_main -> parse('exibe_mensagens');
        $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
        }else{
            $dados_pessoais  = array(
                'nome'      => $_POST['nome'],
                'numerorg'  => $_POST['numerorg'], 
                'emissorrg' => $_POST['emissorrg'], 
                'cpf'       => $_POST['cpf'], 
                'endereco'  => $_POST['endereco'], 
                'cidade'    => $_POST['cidade'], 
                'cep'       => $_POST['cep'], 
                'estado'    => $_POST['estado'], 
                'telefone'  => $_POST['telefone'],
                'celular'   => $_POST['celular']
                );

            $dados_pessoais_sanitizados = sanitiza_dados_pessoais($dados_pessoais);

            $tabela = 'dados_pessoais';

            $resultado = grava_dados_pessoais_usuario($_SESSION['id_user'],$dados_pessoais_sanitizados,$tabela);

            if ($resultado) {
                $tpl = carrega_mensagem_sucesso();
                $mensagem_sucesso = "Seus dados pessoais foram atualizados em nosso sitemas. Em breve você será redirecionando para a próxima etapa da inscrição.";
                $tpl->setVariable('mensagem_sucesso', $mensagem_sucesso);
                $tpl_main -> parse('exibe_mensagens');
                $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
            }
            

        }
}

$tpl_main->show();

echo "<meta HTTP-EQUIV='Refresh' CONTENT='5;URL=aluno_dados_bancarios.php'>";
?>