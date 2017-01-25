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
                $_SESSION['id_user'] = $dados_usuario['id_user'];
                $_SESSION['email'] = $dados_usuario['email'];
                $_SESSION['user_type'] = $dados_usuario['user_type'];

                if ($dados_usuario['user_type'] === 3) {
                    carrega_area_aluno();
                }else if ($dados_usuario['user_type'] === 2) {
                    carrega_area_coordenador();
                }else if ($dados_usuario['user_type'] === 1){
                    carrega_area_administrador();
                }
            }else{
                $errors[] = "Login ou senha não conferem.";
            }
        }
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