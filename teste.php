<?php
require_once "config/init.php";

// $dados_monitoria = retorna_monitoria_ativa();
// $data_inicio = DateTime::createFromFormat('Y-m-d', $dados_monitoria['inicio_inscricao']);
// $data_fim = DateTime::createFromFormat('Y-m-d', $dados_monitoria['fim_inscricao']);

// $data_hoje = new DateTime();

// autoriza_inscricao($dados_monitoria);

$login="coordgrad";
$password = password_hash('senha123', PASSWORD_DEFAULT);
$email="coordgrad@mat.unb.br";


    $query_insere_novo_usuario = "INSERT INTO users (login,password,email) VALUES(:login,:password,:email)";

    $stmt = $PDO->prepare( $query_insere_novo_usuario );


    
        $stmt -> bindParam(':login', $login);   
        $stmt -> bindParam(':password', $password);   
    $stmt -> bindParam(':email', $email);   
      
    
        $result = $stmt->execute();
    


echo password_hash(senha123, PASSWORD_DEFAULT);



?>