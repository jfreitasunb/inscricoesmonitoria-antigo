<?php
require_once "config/init.php";

$dados_monitoria = retorna_monitoria_ativa();
$data_inicio = DateTime::createFromFormat('Y-m-d', $dados_monitoria['inicio_inscricao']);
$data_fim = DateTime::createFromFormat('Y-m-d', $dados_monitoria['fim_inscricao']);

echo $data_inicio->format('d/m/Y');
echo $data_fim->format('d/m/Y');


?>