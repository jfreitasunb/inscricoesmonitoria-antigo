<?php
require_once "../config/init.php";

if (isset($_GET['email'], $_GET['email_code'])) {
    $email = trim(strtolower($_GET['email']));
    $email_code = trim($_GET['email_code']);

    if (!email_exists($email)) {
        $errors[] = "O e-mail informado não está cadastrado no sistema ou já foi ativado.";
    }else if (!ativar_email($email, $email_code)){
        $errors[] = "Não foi possível ativar sua conta. Tente mais tarde.";
    }

    if (!empty($errors)) {
        // mostra_erros($errors);
        print_r($errors);
    }else{
        echo "Sucesso";
        exit();
    }
}else{
    header('Location:../index.php');
    exit();
}
?>