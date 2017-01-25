<?php
require_once "../config/init.php";

if (!empty($_POST)) {
    
    $errors = valida_usuario_login();

    if (empty($errors)) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        print_r(retorna_dados_usuario($username));
    }

    
}else{
    header('Location:../index.php');
    exit();
}

// $campos = implode(', ', array_keys($disciplinas_escolhidas));
// $bind_valores = ':' . implode(', :', array_keys($disciplinas_escolhidas));

// $query_insere_escolha_aluno = "INSERT INTO escolhas_candidatos ($campos) VALUES($bind_valores)";

// $stmt = $PDO->prepare( $query_insere_escolha_aluno );


// foreach ($disciplinas_escolhidas as $key => &$value) {
//     $stmt -> bindParam(':'.$key, $value);   
// }
    
// $result = $stmt->execute();

// if ($result) {
//     echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
//     header("location:../index.php");
//     exit();
// }else{
//     echo "Houve um problema com a sua solicitação. Por favor tente mais tarde.";
// }
?>