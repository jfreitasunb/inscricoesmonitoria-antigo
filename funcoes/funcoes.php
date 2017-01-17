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

function carrega_monitoria($id_monitoria,$nome_disciplina,$monitoria_escolhas = array(),$monitoria_horarios = array()){

    GLOBAL $ROOT_PATH;

    $tpl = new HTML_Template_Sigma($ROOT_PATH);

    $tpl->loadTemplatefile("dados_monitoria.tpl");

    $tpl -> setCurrentBlock("escolhas_possiveis");
    $tpl->setVariable('monitorias_disponiveis', '<option value="'.$id_monitoria.'">'.$nome_disciplina.'</option>');
    $tpl -> parseCurrentBlock("escolhas_possiveis");
        
        
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