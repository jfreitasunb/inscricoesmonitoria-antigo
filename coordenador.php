<?php
require_once "config/init.php";
protect_page();

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

$tpl_menu_coordenador = carrega_menu_coordenador();

$tpl_main -> setVariable('exibe_menus',$tpl_menu_coordenador->get());


// $tpl_dados_bancarios = carrega_template_dados_bancarios();

// $tpl_main -> setVariable('exibe_paginas',$tpl_dados_bancarios->get());



// if (!empty($_POST)) {
    
//     $errors = valida_dados_bancarios();

//     if (!empty($errors)) {
//         $tpl = carrega_mensagem_erro();
//         $tpl->setVariable('mensagem_erros', mostra_erros($errors));
//         $tpl_main -> parse('exibe_mensagens');
//         $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
//     }else{
//         $dados_bancarios  = array(
//             'nomebanco'            => $_POST['nomebanco'],
//             'numerobanco'          => $_POST['numerobanco'], 
//             'agenciabancaria'      => $_POST['agenciabancaria'], 
//             'numerocontacorrente'  => $_POST['numerocontacorrente']
//         );

//         $dados_bancarios_sanitizados = sanitiza_dados($dados_bancarios);

//         $tabela = "dados_bancarios";

//         $resultado = grava_dados_pessoais_usuario($_SESSION['id_user'],$dados_bancarios_sanitizados,$tabela);

//         if ($resultado) {
//                 $tpl = carrega_mensagem_sucesso();
//                 $mensagem_sucesso = "Seus dados bancários foram atualizados em nosso sitemas. Em breve você será redirecionando para a próxima etapa da inscrição.";
//                 $tpl->setVariable('mensagem_sucesso', $mensagem_sucesso);
//                 $tpl_main -> parse('exibe_mensagens');
//                 $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
//                 $http = new HTTP2();
// 				   $http->redirect("aluno_escolher_monitoria.php");
//                 echo "<meta HTTP-EQUIV='Refresh' CONTENT='5;URL=aluno_escolher_monitoria.php'>";
//             }else{
//                 $errors[] = "Houve um problema durante a atualização dos seus dados. Tente novamente mais tarde.";
//                 $tpl = carrega_mensagem_erro();
//                 $tpl->setVariable('mensagem_erros', mostra_erros($errors));
//                 $tpl_main -> parse('exibe_mensagens');
//                 $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
//             }
//     }
// }

$tpl_main->show();
?>