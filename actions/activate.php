<?php
require_once "../config/init.php";

if (isset($_GET['email'], $_GET['email_code'])) {
    $email = trim(strtolower($_GET['email']));
    $email_code = trim($_GET['email_code']);

    echo email_exists($email);

    activate($email, $email_code);
    // if (!email_exists($email)) {
    //     $errors[] = "O e-mail informado não está cadastrado no sistema.";
    // }else if (!activate($email, $email_code)){
    //     $errors[] = "Não foi possível ativar sua conta. Tente mais tarde.";
    // }
}
// activate($email, $email_code);
print_r($errors);
?>