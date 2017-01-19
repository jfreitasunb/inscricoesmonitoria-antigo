<?php
require_once "config/init.php";

$PDO = conecta();

    // $query_retorna_reservas = "SELECT id_monitoria,nome_disciplina FROM discipinas_disponivies";
    // $stmt = $PDO->prepare( $query_retorna_reservas );
    // // $stmt->bindParam( ':id_aluno', $id_aluno );
    // // $stmt->bindParam( ':id_agenda', $id_agenda );
    // $result = $stmt->execute();
    // $rows = [];
    // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($rows);

    // foreach ($rows as $key) {
    //     echo $key['id_monitoria'].'<br>';
    //     echo $key['nome_disciplina'].'<br>';
        
    // }

$tpl_main = new HTML_Template_Sigma($ROOT_PATH);

$tpl_main->loadTemplatefile("cabecalho_rodape.tpl");



$monitoria_horarios['nome_hora_monitoria'] = 'nome_hora_monitoria_';
$monitoria_horarios['id_hora'] = 'id_hora_';
$monitoria_horarios['horario_monitoria'] =  '12 às 14';

$tpl = preenche_template_monitoria();
// $tpl_main -> parse('escolher_disciplina_monitoria');
$tpl_main -> setVariable('escolher_disciplina_monitoria',$tpl->get());
$tpl_main->show();
?>