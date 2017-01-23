<?php
require_once "../config/init.php";
$disciplinas_escolhidas = $_POST;
 
var_dump($disciplinas_escolhidas);


for ($i=0; $i < $numero_escolhas_possiveis; $i++) { 
    if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia' AND $disciplinas_escolhidas['mencao_aluno_'.$i] === 'mencao_vazia') {
        $errors[] = "Você não selecionou a Menção que obteve na disciplina ".$disciplinas_escolhidas['escolha_aluno_'.$i].".";
    }else if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia' AND $disciplinas_escolhidas['ano_cursado_'.$i] === 'ano_vazio') {
        $errors[] = "Você não selecionou o Ano que cursou disciplina ".$disciplinas_escolhidas['escolha_aluno_'.$i].".";
    }else if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia' AND $disciplinas_escolhidas['semestre_cursado_'.$i] === 'semestre_vazio') {
        $errors[] = "Você não selecionou o Semestre que cursou disciplina ".$disciplinas_escolhidas['escolha_aluno_'.$i].".";
    }
}

print_r($errors);



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