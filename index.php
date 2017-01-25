<?php
require_once "config/init.php";

$tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

    $tpl = carrega_template_login_registro();

// if (isset($_SESSION['id_user'])) {
//      echo "aqui";
    
//     // $tpl_main -> parse('escolher_disciplina_monitoria');
    $tpl_main -> setVariable('escolher_disciplina_monitoria',$tpl->get());
    
// }
$tpl_main->show();

?>