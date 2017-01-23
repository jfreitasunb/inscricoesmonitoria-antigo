<?php
require_once "../config/init.php";
$disciplinas_escolhidas = $_POST;
 
// var_dump($disciplinas_escolhidas);

// var_dump($_FILES);

$erros_validacao = valida_escolhas_aluno($disciplinas_escolhidas);

$id_candidato = 2;
$ano_monitoria = '2017';
$semestre_monitoria = '1';

// if (empty($errors)){
//     $resultado = grava_escolhas_monitoria($id_candidato, $ano_monitoria, $semestre_monitoria,$disciplinas_escolhidas);
    
//     if (in_array(0, $resultado)) {
//         $errors[] = "Houve um erro na hora de gravar suas escolhas. Tente novamente mais tarde.";
//     }else{


$resultado_upload = upload_historico($id_candidato);
    

var_dump($resultado_upload);




     

 //Usar para processar o cadastro do candidato. 

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