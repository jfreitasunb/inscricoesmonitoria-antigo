<?php
function upload_historico($id_candidato){

    GLOBAL $ROOT_PATH;

    $erros_upload = array();

    $_UP['pasta'] = $ROOT_PATH."uploads/";
    // Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho'] = 1024 * 1024 * 5; // 10Mb
     
    // Array com as extensões permitidas
    $_UP['extensoes'] = array("jpg","jpeg", "pdf", "png");
         
    // Renomeia o arquivo?
    $_UP['renomeia'] = true;

    if ($_FILES['arquivo']['name']!=""){
        if ($_FILES['arquivo']['error'] != 0) {
            $erros_upload[] = "Não foi possível enviar seu arquivo.";
            exit();
        }

        $extensao_00=explode(".",$_FILES['arquivo']['name']);
        $extensao=strtolower(end($extensao_00));
        
        if (array_search($extensao, $_UP['extensoes']) === false) {
            $erros_upload[]= "Por favor, envie arquivos com as seguintes extens&otilde;es: tex";
            exit();
        }


        if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
            $erros_upload[] = "O arquivo enviado &eacute; muito grande, envie arquivos de at&eacute; 2Mb.";
            exit();
        }else {
            if ($_UP['renomeia'] == true) {
                $nome_final = "historico_".$id_candidato;
            }else{
                $nome_final = $_FILES['arquivo']['name'];
            }
            
            if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'].$nome_final.".".$extensao)){
                $erros_upload[] = "N&atilde;o foi poss&iacute;vel enviar o arquivo, tente novamente";
            }
        }

        return $erros_upload;
    }


}
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