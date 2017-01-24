<?php
function upload_historico($id_candidato){

    GLOBAL $ROOT_PATH;
    GLOBAL $PDO;
    GLOBAL $errors;

    $data = date("Y-m-d H:i:s");

    $_UP['pasta'] = $ROOT_PATH."uploads/";
    // Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho'] = 1024 * 1024 * 5; // 10Mb
     
    // Array com as extensões permitidas
    $_UP['extensoes'] = array("jpg","jpeg", "pdf", "png");
         
    // Renomeia o arquivo?
    $_UP['renomeia'] = true;

    if ($_FILES['arquivo']['name']!=""){
        if ($_FILES['arquivo']['error'] != 0) {
            $errors[] = "Não foi possível enviar seu arquivo.";
            exit();
        }

        $extensao_00=explode(".",$_FILES['arquivo']['name']);
        $extensao=strtolower(end($extensao_00));
        
        if (array_search($extensao, $_UP['extensoes']) === false) {
            $errors[]= "Por favor, envie arquivos com as seguintes extens&otilde;es: tex";
            exit();
        }


        if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
            $errors[] = "O arquivo enviado &eacute; muito grande, envie arquivos de at&eacute; 2Mb.";
            exit();
        }else {
            if ($_UP['renomeia'] == true) {
                $nome_final = md5("historico_".$id_candidato).".".$extensao;
            }else{
                $nome_final = $_FILES['arquivo']['name'];
            }
            
            if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'].$nome_final)){
                $errors[] = "N&atilde;o foi poss&iacute;vel enviar o arquivo, tente novamente";
            }else{
                $query_insere_historico = "INSERT INTO arquivos_enviados (id_candidato,nome_arquivo,data_envio) VALUES(:id_candidato, :nome_arquivo, :data)";
                $stmt = $PDO->prepare( $query_insere_historico );
                echo $id_candidato;
                $stmt -> bindParam(':id_candidato', $id_candidato);
                $stmt -> bindParam(':nome_arquivo', $nome_final);
                $stmt -> bindParam(':data', $data);
                $result = $stmt->execute();

                if (!$result) {
                    $errors[] = "Não foi possível gravar seu histórico no banco de dados. Tente novamente mais tarde.";
                }
            }
        }

        return $errors;
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

function finaliza_escolhas($id_candidato, $ano_monitoria_ativa, $semestre_monitoria_ativa,$disciplinas_escolhidas){

    GLOBAL $PDO;
    GLOBAL $errors;

    $escolheu_hora = horarios_escolhidos_candidato($disciplinas_escolhidas);
    $hora_escolhida ="";
    foreach ($escolheu_hora as $key) {
        $hora_escolhida .= $disciplinas_escolhidas[$key];
    }
 
    $finaliza_escolhas = TRUE;
 
    $campos_finais = 'id_candidato, tipo_monitoria, hora_escolhida, concordatermos, ano_monitoria_ativa, semestre_monitoria_ativa, finaliza_escolhas';
 
    $bind_valores_finais = ':id_candidato, :tipo_monitoria, :hora_escolhida, :concordatermos, :ano_monitoria_ativa, :semestre_monitoria_ativa, :finaliza_escolhas';
 
    $query_insere_escolha_finais = "INSERT INTO finaliza_escolhas ($campos_finais) VALUES($bind_valores_finais)";
     
    $stmt = $PDO->prepare( $query_insere_escolha_finais );
    $stmt -> bindParam(':id_candidato', $id_candidato);
    $stmt -> bindParam(':tipo_monitoria', $disciplinas_escolhidas['tipo_monitoria']);
    $stmt -> bindParam(':hora_escolhida', $hora_escolhida);
    $stmt -> bindParam(':concordatermos', $disciplinas_escolhidas['concordatermos']);
    $stmt -> bindParam(':ano_monitoria_ativa', $ano_monitoria_ativa);
    $stmt -> bindParam(':semestre_monitoria_ativa', $semestre_monitoria_ativa);
    $stmt -> bindParam(':finaliza_escolhas', $finaliza_escolhas);
    $result = $stmt->execute();

    if (!$result) {
        $errors[] = "Não foi possível finalizar suas escolhas.";
    }

    return $errors;
}

?>