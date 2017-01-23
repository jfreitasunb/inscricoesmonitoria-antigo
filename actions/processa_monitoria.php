<?php
require_once "../config/init.php";
$disciplinas_escolhidas = $_POST;
 
var_dump($disciplinas_escolhidas);

$errors = valida_escolhas_aluno($disciplinas_escolhidas);

$id_candidato = 1;
$ano_monitoria = '2017';
$semestre_monitoria = '1';

// if (empty($errors)){
//     grava_escolhas_monitor($id_candidato, $ano_monitoria, $semestre_monitoria,$disciplinas_escolhidas);
// }else{
//     print_r($errors);
// }


$escolha_candidato = array_filter(array_keys($disciplinas_escolhidas),
        function($key) {
            return substr($key, 0, 14) === 'escolha_aluno_';
        }
    );

print_r($escolha_candidato);


$campos = 'id_candidato, escolha_aluno, mencao_aluno, ano_cursado, semestre_cursado, tipomonitoria, nome_hora_monitoria, concordatermos';

$bind_valores = ':id_candidato, :escolha_aluno, :mencao_aluno, :ano_cursado, :semestre_cursado, :tipomonitoria, :nome_hora_monitoria, :concordatermos';

    for ($i=0; $i < $numero_escolhas_possiveis; $i++) { 
        if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia') {
            $query_insere_escolha_aluno = "INSERT INTO escolhas_candidatos ($campos) VALUES($bind_valores)";
            $stmt -> bindParam(':'.$key, $value);   
            echo $query_insere_escolha_aluno;
            // $stmt = $PDO->prepare( $query_insere_escolha_aluno );
            // $result = $stmt->execute();
        }
    }

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