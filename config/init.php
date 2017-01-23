<?php
require_once "/Arquivos/Dropbox/php/vagrant/rivendel/www/monitoriamat/config/caminhos.php";
require_once "HTML/Template/Sigma.php";
require_once $ROOT_PATH."funcoes/general.php";
require_once $ROOT_PATH."funcoes/users.php";
require_once $ROOT_PATH."config/caminhos.php";
require_once $ROOT_PATH.'db/db_config.php';
$PDO = conecta();
$numero_escolhas_possiveis = 4;
$numero_horarios_possiveis = 3;
$errors = array();
?>