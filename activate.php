<?php
require_once "config/init.php";

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

if (isset($_GET['email'], $_GET['email_code'])) {
    $email = trim(strtolower($_GET['email']));
    $email_code = trim($_GET['email_code']);

    if (!email_exists($email)) {
        $errors[] = "O e-mail informado não está cadastrado no sistema ou já foi ativado.";
    }else if (!ativar_email($email, $email_code)){
        $errors[] = "Não foi possível ativar sua conta. Tente mais tarde.";
    }

    if (!empty($errors)) {
        
        $tpl = carrega_mensagem_erro();
        $tpl->setVariable('mensagem_erros', mostra_erros($errors));
        $tpl_main -> parse('exibe_mensagens');
        $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
                
    }else{
        $tpl = carrega_mensagem_sucesso();
        $mensagem_sucesso = "Sua conta foi ativada com sucesso. Agora você pode efetuar o login e fazer sua inscrição à Monitoria do MAT/UnB. Em breve você será redirecionando para a página de login.";
        $tpl->setVariable('mensagem_sucesso', $mensagem_sucesso);
        $tpl_main -> parse('exibe_mensagens');
        $tpl_main -> setVariable('exibe_mensagens',$tpl->get());
    }
}else{
    header('Location:index.php');
    exit();
}
$tpl_main->show();
echo "<meta HTTP-EQUIV='Refresh' CONTENT='5;URL=index.php'>";
?>