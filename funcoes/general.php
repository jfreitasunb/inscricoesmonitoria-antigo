<?php

function conecta(){
    try
    {
        $PDO = new PDO( "pgsql:host=".PGSQL_HOST.";dbname=".PGSQL_DB_NAME.";user=".PGSQL_USER.";password=".PGSQL_PASSWORD);
        $PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }
    catch ( PDOException $e )
    {
        echo 'Erro ao conectar com o Postgres: ' . $e->getMessage();
    }

    return $PDO;
}

function pega_disciplinas_monitoria(){
    
    GLOBAL $PDO;

    $query_retorna_disciplinas = "SELECT id_monitoria,nome_disciplina FROM disciplinas_disponivies";
    $stmt = $PDO->prepare( $query_retorna_disciplinas );
    // $stmt->bindParam( ':id_aluno', $id_aluno );
    // $stmt->bindParam( ':id_agenda', $id_agenda );
    $result = $stmt->execute();
    $rows = [];
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}



function pega_horario_monitoria(){
    
    GLOBAL $PDO;

    $query_retorna_horarios_monitoria = "SELECT id_horario,horario_monitoria FROM horario_monitoria";
    $stmt = $PDO->prepare( $query_retorna_horarios_monitoria );
    // $stmt->bindParam( ':id_aluno', $id_aluno );
    // $stmt->bindParam( ':id_agenda', $id_agenda );
    $result = $stmt->execute();
    $rows = [];
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}

function preenche_template_monitoria(){

    GLOBAL $PATH_TEMPLATES;
    GLOBAL $numero_escolhas_possiveis;

    $tpl = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tpl->loadTemplatefile("dados_monitoria.tpl");

    $monitoria_ativas = pega_disciplinas_monitoria();

    

    for ($i=0; $i < $numero_escolhas_possiveis; $i++) { 

        $tpl -> setCurrentBlock("escolhas_possiveis");
            $tpl->setVariable('monitorias_disponiveis', '<option selected="selected" value="disciplina_vazia">Selecione a disciplina</option>');
            $tpl -> parseCurrentBlock("escolhas_possiveis");

        foreach ($monitoria_ativas as $key) {

            $tpl -> setCurrentBlock("escolhas_possiveis");
            $tpl->setVariable('monitorias_disponiveis', '<option value="'.$key['id_monitoria'].'">'.$key['nome_disciplina'].'</option>');
            $tpl -> parseCurrentBlock("escolhas_possiveis");

        }
            
        for ($l=date('Y'); $l > date('Y') - 5; $l--) { 
            $tpl -> setCurrentBlock("anos_possiveis");
            $tpl->setVariable('ano_cursou_disciplina', '<option value="'.$l.'">'.$l.'</option>');
            $tpl -> parseCurrentBlock("anos_possiveis");
        }

        $monitoria_escolhas['escolha_aluno'] = 'escolha_aluno_'.$i;
        $monitoria_escolhas['mencao_aluno'] = 'mencao_aluno_'.$i;
        $monitoria_escolhas['ano_cursado'] = 'ano_cursado_'.$i;
        $monitoria_escolhas['semestre_cursado'] = 'semestre_cursado_'.$i;

        $tpl -> setCurrentBlock("numero_escolhas");
        $tpl->setVariable($monitoria_escolhas);
        $tpl -> parseCurrentBlock("numero_escolhas");

    }    
    
    $monitoria_horarios = pega_horario_monitoria();

    $i=0;
    foreach ($monitoria_horarios as $key) {
        $tpl -> setCurrentBlock("horarios_disponiveis");
        $tpl->setVariable(array('nome_hora_monitoria' => 'nome_hora_monitoria_'.$i,
            'id_hora' => $key['id_horario'], 'horario_monitoria' => $key['horario_monitoria']));
        $tpl -> parseCurrentBlock("horarios_disponiveis");
        $i++;
    }

    return $tpl;
}

function horarios_escolhidos_candidato($disciplinas_escolhidas){
    $escolhas = array_filter(array_keys($disciplinas_escolhidas),
        function($key) {
            return substr($key, 0, 20) === 'nome_hora_monitoria_';
        }
    );

    return $escolhas;
}

function valida_escolhas_aluno($disciplinas_escolhidas){

    GLOBAL $numero_escolhas_possiveis;
    GLOBAL $numero_horarios_possiveis;
    $erros_validacao = array();

    $conta_presenca = array_count_values($disciplinas_escolhidas);

    if (array_key_exists('disciplina_vazia', $conta_presenca) AND $conta_presenca['disciplina_vazia'] === $numero_escolhas_possiveis) {
        $erros_validacao[] = "Você deve escolher pelo menos uma disciplina para a monitoria.";
    }

    for ($i=0; $i < $numero_escolhas_possiveis; $i++) { 
        if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia' AND $disciplinas_escolhidas['mencao_aluno_'.$i] === 'mencao_vazia') {
            $erros_validacao[] = "Você não selecionou a Menção que obteve na disciplina ".$disciplinas_escolhidas['escolha_aluno_'.$i].".";
        }else if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia' AND $disciplinas_escolhidas['ano_cursado_'.$i] === 'ano_vazio') {
            $erros_validacao[] = "Você não selecionou o Ano que cursou disciplina ".$disciplinas_escolhidas['escolha_aluno_'.$i].".";
        }else if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia' AND $disciplinas_escolhidas['semestre_cursado_'.$i] === 'semestre_vazio') {
            $erros_validacao[] = "Você não selecionou o Semestre que cursou disciplina ".$disciplinas_escolhidas['escolha_aluno_'.$i].".";
        }
    }

    $escolheu_hora = horarios_escolhidos_candidato($disciplinas_escolhidas);

    if (empty($escolheu_hora)) {
        $erros_validacao[] = "Você deve escolher pelo menos um horário para a monitoria.";
    }

    if (empty($disciplinas_escolhidas['concordatermos'])) {
        $erros_validacao[] = "Você deve concordar com os termos da monitoria.";
    }

    return $erros_validacao;
}
?>