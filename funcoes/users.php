<?php
function grava_escolhas_monitoria($id_candidato, $ano_monitoria, $semestre_monitoria,$disciplinas_escolhidas){
    
    GLOBAL $PDO;
    GLOBAL $numero_escolhas_possiveis;

    $campos = 'id_candidato, escolha_aluno, mencao_aluno, ano_cursado, semestre_cursado, ano_monitoria_ativa, semestre_monitoria_ativa';

    $bind_valores = ':id_candidato, :escolha_aluno, :mencao_aluno, :ano_cursado, :semestre_cursado, :ano_monitoria_ativa, :semestre_monitoria_ativa';

    $ano_monitoria_ativa = $ano_monitoria;
    $semestre_monitoria_ativa = $semestre_monitoria;
    $escolheu_hora = horarios_escolhidos_candidato($disciplinas_escolhidas);

    $gravou = array();

    for ($i=0; $i < $numero_escolhas_possiveis; $i++) { 
        if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia') {
            
            $query_insere_escolha_aluno = "INSERT INTO escolhas_candidatos ($campos) VALUES($bind_valores)";
            
            $stmt = $PDO->prepare( $query_insere_escolha_aluno );
            $stmt -> bindParam(':id_candidato', $id_candidato);
            $stmt -> bindParam(':escolha_aluno', $disciplinas_escolhidas['escolha_aluno_'.$i]);
            $stmt -> bindParam(':mencao_aluno', $disciplinas_escolhidas['mencao_aluno_'.$i]);
            $stmt -> bindParam(':ano_cursado', $disciplinas_escolhidas['ano_cursado_'.$i]);
            $stmt -> bindParam(':semestre_cursado', $disciplinas_escolhidas['semestre_cursado_'.$i]);
            $stmt -> bindParam(':ano_monitoria_ativa', $ano_monitoria_ativa);
            $stmt -> bindParam(':semestre_monitoria_ativa', $semestre_monitoria_ativa);
            $result = $stmt->execute();

            if ($result) {
                $gravou[] = 1;
            }else{
                $gravou[] = 0;
            }
        }
    }

    return $gravou;
}

?>