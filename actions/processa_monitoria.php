<?php
require_once "../config/init.php";
$disciplinas_escolhidas = $_POST;
 

$campos = implode(', ', array_keys($disciplinas_escolhidas));
$bind_valores = ':' . implode(', :', array_keys($disciplinas_escolhidas));

$query_insere_escolha_aluno = "INSERT INTO escolhas_candidatos ($campos) VALUES($bind_valores)";

$stmt = $PDO->prepare( $query_insere_escolha_aluno );


foreach ($disciplinas_escolhidas as $key => &$value) {
    $stmt -> bindParam(':'.$key, $value);   
}
    
$result = $stmt->execute();

if ($result) {
    echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
    header("location:../index.php");
    exit();
}else{
    echo "Houve um problema com a sua solicitação. Por favor tente mais tarde.";
}


?>