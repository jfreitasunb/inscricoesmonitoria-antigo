<?php
require_once 'HTML/Template/Sigma.php';
require_once 'config/caminhos.php';
require_once 'db/db_config.php';

function conecta(){
    try
    {
        $PDO = new PDO( "pgsql:host=".PGSQL_HOST.";dbname=".PGSQL_DB_NAME.";user=".PGSQL_USER.";password=".PGSQL_PASSWORD);

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

function carrega_monitoria(){

    GLOBAL $ROOT_PATH;

    $tpl = new HTML_Template_Sigma($ROOT_PATH);

    $tpl->loadTemplatefile("dados_monitoria.tpl");

    $monitoria_ativas = pega_disciplinas_monitoria();

    for ($i=0; $i < 4; $i++) { 

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
?>