<?php
require_once "../config/init.php";
$disciplinas_escolhidas = $_POST;
$errors = valida_escolhas_aluno($disciplinas_escolhidas);

if (empty($errors)){
    $resultado = grava_escolhas_monitoria($id_candidato, $ano_monitoria, $semestre_monitoria,$disciplinas_escolhidas);
    
    if (in_array(0, $resultado)) {
        $errors[] = "Houve um erro na hora de gravar suas escolhas. Tente novamente mais tarde.";
    }else{
        $errors = upload_historico($id_candidato);
        if (empty($errors)) {
            $errors = finaliza_escolhas($id_candidato, $ano_monitoria, $semestre_monitoria,$disciplinas_escolhidas);
        }
    }
}
?>