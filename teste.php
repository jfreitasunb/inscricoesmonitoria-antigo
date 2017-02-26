<?php
require_once "config/init.php";

// $dados_monitoria = retorna_monitoria_ativa();
// $data_inicio = DateTime::createFromFormat('Y-m-d', $dados_monitoria['inicio_inscricao']);
// $data_fim = DateTime::createFromFormat('Y-m-d', $dados_monitoria['fim_inscricao']);

// $data_hoje = new DateTime();

// autoriza_inscricao($dados_monitoria);

// $login="coordgrad";
// $password = password_hash('senha123', PASSWORD_DEFAULT);
// $email="coordgrad@mat.unb.br"


//     $query_insere_novo_usuario = "INSERT INTO user (login,password,email) VALUES(:login,:password,:email)";

//     $stmt = $PDO->prepare( $query_insere_novo_usuario );


    
//         $stmt -> bindParam(':login', $login);   
//         $stmt -> bindParam(':password', $password);   
//     $stmt -> bindParam(':email', $email);   
      
    
//         $result = $stmt->execute();
    


// echo password_hash(senha123, PASSWORD_DEFAULT);

$date = new DateTime;

$mes = $date->format('m');
$ano = $date->format('y');

if ($mes < 7) {
	$ano_semestre_ira = "02/".($ano-1);
	
}else{
	$ano_semestre_ira = "01/".$ano;
}

echo $ano_semestre_ira;


?>