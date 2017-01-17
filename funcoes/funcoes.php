<?php
require_once 'HTML/Template/Sigma.php';
require_once 'config/caminhos.php';
require_once 'db/db_config.php';

function conecta(){
    try
    {
        $PDO = new PDO( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8') );

    }
    catch ( PDOException $e )
    {
        echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
    }
    return $PDO;
}

function pega_disciplinas_monitoria(){
    $PDO = conecta();

    $query_retorna_reservas = "SELECT id_monitoria,nome_disciplina FROM discipinas_disponivies";
    $stmt = $PDO->prepare( $query_retorna_reservas );
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

    $tpl -> setCurrentBlock("numero_escolhas");
    
    $tpl->setVariable($monitoria_escolhas);
    
    $tpl -> parseCurrentBlock("numero_escolhas");

    $tpl -> setCurrentBlock("horarios_disponiveis");
    $tpl->setVariable($monitoria_horarios);
    $tpl -> parseCurrentBlock("horarios_disponiveis");

    return $tpl;
}
?>