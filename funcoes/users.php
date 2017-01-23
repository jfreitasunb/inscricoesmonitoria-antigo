<?php
function grava_escolhas_monitor($id_candidato, $ano_monitoria, $semestre_monitoria,$disciplinas_escolhidas){
    
    GLOBAL $PDO;
    GLOBAL $numero_escolhas_possiveis;

    $campos = 'id_candidato, escolha_aluno, mencao_aluno, ano_cursado, semestre_cursado, tipomonitoria, nome_hora_monitoria, concordatermos';

    for ($i=0; $i < $numero_escolhas_possiveis; $i++) { 
        if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia') {
            $query_insere_escolha_aluno = "INSERT INTO escolhas_candidatos ($campos) VALUES($bind_valores)";
            $stmt = $PDO->prepare( $query_insere_escolha_aluno );
            $result = $stmt->execute();
        }
    }



}

?>