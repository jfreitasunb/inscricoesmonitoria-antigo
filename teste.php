<?php
require_once "config/init.php";

$id_user = 55;
$tabela = 'users';
$dados_usuario = user_data($id_user, $tabela, 'id_user', 'login', 'password', 'email', 'validation_code', 'user_type');

print_r($dados_usuario);
?>