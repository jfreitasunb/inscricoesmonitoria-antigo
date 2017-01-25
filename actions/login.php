<?php
require_once "../config/init.php";

if (!empty($_POST)) {
    
    $errors = valida_usuario_login();

    if (empty($errors)) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if (login_existe($username)){
            $dados_usuario = retorna_dados_usuario($username);
            if ($dados_usuario['ativo'] == 0){
                $errors[] = "Você não ativou sua conta ainda. Verifique se recebeu um e-mail com o link de ativação de conta.";
            }else if (password_verify($password,$dados_usuario['password'])) {
                echo "Logado";
            }else{
                $errors[] = "Login ou senha não conferem.";
            }
        }

    }

    
}else{
    header('Location:../index.php');
    exit();
}

print_r($errors);

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