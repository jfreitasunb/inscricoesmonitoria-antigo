<?php
require_once "../config/init.php";

if (isset($_GET['email'], $_GET['email_code'])) {
    $email = trim($_GET['email']);
    $email_code = trim($_GET['email_code']);

    if (email_exists($email)) {
        
    }else{
        $errors[] = "O e-mail informado não está cadastrado no sistema.";
    }
}
?>