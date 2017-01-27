<?php
session_start();
require_once "/Arquivos/Dropbox/php/vagrant/rivendel/www/monitoriamat/config/caminhos.php";
require_once "HTML/Template/Sigma.php";
require_once $ROOT_PATH."funcoes/general.php";
require_once $ROOT_PATH."funcoes/users.php";
require_once $ROOT_PATH."config/caminhos.php";
require_once $ROOT_PATH.'db/db_config.php';
require_once $ROOT_PATH."lib/PHPMailer/PHPMailerAutoload.php";
$PDO = conecta();
$numero_escolhas_possiveis = 4;
$numero_horarios_possiveis = 3;
$errors = array();
$STRING_VALIDA_EMAIL = "EsN7Qh2G#U(i24g@LQ=^=NMX74CmuVYZmAPNW?nE3ss6hxtUnvLZBjbD.V[7Y,8LW6trtj%CZWKr^aREKgm]QYW@87xZW4]CEK4mT[yz*o&t6VvzT,E2BGx2j2BP7%Jo{EkRM2Z=Pa4qWu4GeT83)pA]9*rHYctr}L4ka[c6YiweZq=Q>m$7tfPBQoW8wgFm86k8[iDu?HBA[9kiRJeH)7QGnND6oFAbD2Vq(2acX+TAmQbMq3jPUVJ,JPaA]9.)"; /*string usada para gerar o código de validação do e-mail. Deve ser grande por questões de segurança.*/
?>