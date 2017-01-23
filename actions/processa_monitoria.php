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


$campos = 'id_candidato, escolha_aluno, mencao_aluno, ano_cursado, semestre_cursado, ano_monitoria_ativa, semestre_monitoria_ativa';

$bind_valores = ':id_candidato, :escolha_aluno, :mencao_aluno, :ano_cursado, :semestre_cursado, :ano_monitoria_ativa, :semestre_monitoria_ativa';

$campos2 = 'id_candidato, escolha_aluno, mencao_aluno, ano_cursado, semestre_cursado, tipomonitoria, nome_hora_monitoria, concordatermos, ano_monitoria_ativa, semestre_monitoria_ativa';

$bind_valores2 = ':id_candidato, :escolha_aluno, :mencao_aluno, :ano_cursado, :semestre_cursado, :tipomonitoria, :nome_hora_monitoria, :concordatermos, :ano_monitoria_ativa, :semestre_monitoria_ativa';

$ano_monitoria_ativa = $ano_monitoria;
$semestre_monitoria_ativa = $semestre_monitoria;

$escolheu_hora = horarios_escolhidos_candidato($disciplinas_escolhidas);



foreach ($escolheu_hora as $key) {
    $hora_escolhida .=$disciplinas_escolhidas[$key];
}

$campos_finais = 'id_candidato, tipomonitoria, hora_escolhida, concordatermos, historico, ano_monitoria_ativa, semestre_monitoria_ativa, finaliza_escolhas';

$bind_valores_finais = ':id_candidato, :tipomonitoria, :hora_escolhida, :concordatermos, :historico, :ano_monitoria_ativa, :semestre_monitoria_ativa, :finaliza_escolhas';

$query_insere_escolha_aluno = "INSERT INTO escolhas_candidatos ($campos) VALUES($bind_valores)";
$stmt = $PDO->prepare( $query_insere_escolha_aluno );
$stmt -> bindParam(':id_candidato', $id_candidato);
$stmt -> bindParam(':tipo_monitoria', $disciplinas_escolhidas['tipo_monitoria']);
$stmt -> bindParam(':hora_escolhida', $hora_escolhida);
$stmt -> bindParam(':concordatermos', $disciplinas_escolhidas['concordatermos']);
$stmt -> bindParam(':historico', $disciplinas_escolhidas['historico']);
$stmt -> bindParam(':ano_monitoria_ativa', $ano_monitoria_ativa);
$stmt -> bindParam(':semestre_monitoria_ativa', $semestre_monitoria_ativa);
$stmt -> bindParam(':finaliza_escolhas', 'TRUE');
$result = $stmt->execute();

            
            // $query_insere_escolha_aluno = "INSERT INTO escolhas_candidatos ($campos) VALUES($bind_valores)";
            
            // $stmt = $PDO->prepare( $query_insere_escolha_aluno );
            // $stmt -> bindParam(':id_candidato', $id_candidato);
            // $stmt -> bindParam(':escolha_aluno', $disciplinas_escolhidas['escolha_aluno_'.$i]);
            // $stmt -> bindParam(':mencao_aluno', $disciplinas_escolhidas['mencao_aluno_'.$i]);
            // $stmt -> bindParam(':ano_cursado', $disciplinas_escolhidas['ano_cursado_'.$i]);
            // $stmt -> bindParam(':semestre_cursado', $disciplinas_escolhidas['semestre_cursado_'.$i]);
            // $stmt -> bindParam(':ano_monitoria_ativa', $ano_monitoria_ativa);
            // $stmt -> bindParam(':semestre_monitoria_ativa', $semestre_monitoria_ativa);
            // $result = $stmt->execute();
     

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