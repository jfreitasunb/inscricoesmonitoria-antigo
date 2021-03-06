<?php
require_once "../config/init.php";

if (!empty($_POST)) {
    
    $errors = valida_usuario_registrar();

    if (empty($errors)) {
        $nome = htmlentities($_POST['nome'], ENT_QUOTES, "UTF-8");
        $dados_usuario_novo = prepara_dados();
        $errors = grava_usuario_novo($dados_usuario_novo);

        if (empty($errors)) {
            $validation_code = $dados_usuario_novo['validation_code'];
            $email = $dados_usuario_novo['email'];

            $resultado = envia_email_ativa_conta($nome,$email,$validation_code);

            if ($resultado) {
                header('Location: processa_nova_conta.php?sucesso');
                exit();
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