<?php
require_once 'HTTP2.php';

function ira_ano_semestre(){
    
    $date = new DateTime;
    $mes = $date->format('m');
    $ano = $date->format('y');
    
    if ($mes < 7) {
    $ano_semestre_ira = "02/".($ano-1);
    }else{
        $ano_semestre_ira = "01/".$ano;
    }

    return $ano_semestre_ira;

}

function seleciona_disciplinas_para_monitoria(){

    GLOBAL $PDO;

    $query_monta_monitoria = "SELECT codigo,nome FROM disciplinas_mat WHERE status = 'grad' ORDER by codigo";

    $stmt = $PDO -> prepare($query_monta_monitoria);

    $result = $stmt->execute();

    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $dados;
}

function retorna_monitoria_ativa(){

    GLOBAL $PDO;

    $query_retorna_monitoria_ativa = "SELECT * FROM configura_monitoria ORDER BY id_monitoria DESC
LIMIT 1";

    $stmt = $PDO -> prepare($query_retorna_monitoria_ativa);

    $result = $stmt->execute();

    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    return $dados;

}

function autoriza_inscricao(){

    $dados_monitoria = retorna_monitoria_ativa();
    if (!empty($dados_monitoria)) {
        $inicio = DateTime::createFromFormat('Y-m-d', $dados_monitoria['inicio_inscricao']);
        $fim = DateTime::createFromFormat('Y-m-d', $dados_monitoria['fim_inscricao']);
        $data_inicio = $inicio->format('Y-m-d');
        $data_fim = $fim->format('Y-m-d');

        $data_hoje = (new DateTime())->format('Y-m-d');

        if ($data_hoje >= $data_inicio && $data_hoje <= $data_fim) {
            return true;
        }else{
            return false;
        }   
    }else{
        return false;
    }
}

function retorna_somente_numeros($cpf){

    $cpf = preg_replace('/\D/', '', $cpf);

    return $cpf;
}

function valida_CPF($cpf) {
 
    // Verifica se um número foi informado
    if(empty($cpf)) {
        return false;
    }
 
    // Elimina possivel mascara
    $cpf = preg_replace('/\D/', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
     
    // Verifica se o numero de digitos informados é igual a 11 
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' || 
        $cpf == '11111111111' || 
        $cpf == '22222222222' || 
        $cpf == '33333333333' || 
        $cpf == '44444444444' || 
        $cpf == '55555555555' || 
        $cpf == '66666666666' || 
        $cpf == '77777777777' || 
        $cpf == '88888888888' || 
        $cpf == '99999999999') {
        return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF é válido
     } else {   
         
        for ($t = 9; $t < 11; $t++) {
             
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
 
        return true;
    }
}

function carrega_base_site(){
    
    GLOBAL $PATH_TEMPLATES;
    GLOBAL $SITE_INSCRICAO_MONITORIA;
    
    $tpl_main = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tpl_main->loadTemplatefile("cabecalho_rodape.tpl");

    $tpl_main->setVariable('url_site', $SITE_INSCRICAO_MONITORIA);

    return $tpl_main;

}

function carrega_menu_aluno(){
    
    GLOBAL $PATH_TEMPLATES;
    
    $tpl = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tpl->loadTemplatefile("menu_aluno.tpl");

    $menu_aluno['dados_pessoais'] = 'aluno_dados_pessoais.php';
    $menu_aluno['dados_bancarios'] = 'aluno_dados_bancarios.php';
    $menu_aluno['dados_academicos'] = 'aluno_dados_academicos.php';
    $menu_aluno['escolher_monitoria'] = 'aluno_escolher_monitoria.php';

    foreach ($menu_aluno as $key => $value) {
        $tpl->setVariable($key, $value);
    }
    
    return $tpl;

}

function carrega_template_gera_relatorios(){

    GLOBAL $PATH_TEMPLATES;
    
    $tpl = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tpl->loadTemplatefile("relatorios.tpl");

    $relatorios['dados_pessoais'] = 'aluno_dados_pessoais.php';
    $relatorios['escolher_monitoria'] = 'aluno_escolher_monitoria.php';
    $relatorios['dados_bancarios'] = 'aluno_dados_bancarios';

    foreach ($menu_aluno as $key => $value) {
        $tpl->setVariable($key, $value);
    }
    
    return $tpl;
}


function carrega_template_configura_monitoria(){
    GLOBAL $PATH_TEMPLATES;
    
    $tpl = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tpl->loadTemplatefile("configura_monitoria.tpl");

    $lista_disciplinas = seleciona_disciplinas_para_monitoria();
    // print_r($lista_disciplinas);
    $i=0;
    
    while ($i < sizeof($lista_disciplinas)+1) { 
        $tpl -> setCurrentBlock("lista_disciplinas");
        $tpl->setVariable('codigo_disciplina', 'value="'.$lista_disciplinas[$i]['codigo'].'"');
        $tpl->setVariable('nome_disciplina', $lista_disciplinas[$i]['nome']);
        $tpl->setVariable('codigo_disciplina2', 'value="'.$lista_disciplinas[$i+1]['codigo'].'"');
        $tpl->setVariable('nome_disciplina2', $lista_disciplinas[$i+1]['nome']);
        $tpl -> parseCurrentBlock("lista_disciplinas");
        $i = $i+2;
        
    }
    
        

    foreach ($menu_coordenador as $key => $value) {
        $tpl->setVariable($key, $value);
    }
    
    return $tpl;
}

function carrega_menu_coordenador(){
    
    GLOBAL $PATH_TEMPLATES;
    
    $tpl = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tpl->loadTemplatefile("menu_coordenador.tpl");

    $menu_coordenador['configura_monitoria'] = 'coordenador_configura_monitoria.php';
    $menu_coordenador['gera_relatorios'] = 'coordenador_gera_relatorios.php';

    foreach ($menu_coordenador as $key => $value) {
        $tpl->setVariable($key, $value);
    }
    
    return $tpl;

}

function carrega_template_dados_pessoais_aluno(){
    
    GLOBAL $PATH_TEMPLATES;

    $tabela = 'dados_pessoais';

    $dados_usuario=user_data($_SESSION['id_user'],$tabela,'nome','numerorg','emissorrg','cpf','endereco','cidade','cep','estado','telefone','celular');
    
    $tpl = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tpl->loadTemplatefile("dados_pessoais.tpl");

    foreach ($dados_usuario as $key => $value) {
        $tpl->setVariable($key,'value="'.$value.'"');    
    }
    
    return $tpl;

}

function carrega_template_dados_bancarios(){
    
    GLOBAL $PATH_TEMPLATES;
    
    $tpl = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tabela = 'dados_bancarios';

    $dados_bancarios_usuario=user_data($_SESSION['id_user'],$tabela,'nomebanco','numerobanco','agenciabancaria','numerocontacorrente');

    $tpl->loadTemplatefile("dados_bancarios.tpl");

    foreach ($dados_bancarios_usuario as $key => $value) {
        $tpl->setVariable($key,'value="'.$value.'"');    
    }
    
    return $tpl;

}

function carrega_template_dados_academicos(){
    
    GLOBAL $PATH_TEMPLATES;

    $ano_semestre_ira = ira_ano_semestre();
    
    $tpl = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tabela = 'dados_academicos';



    // $dados_bancarios_usuario=user_data($_SESSION['id_user'],$tabela,'nomebanco','numerobanco','agenciabancaria','numerocontacorrente');

    $tpl->loadTemplatefile("dados_academicos.tpl");
    $tpl->setVariable('ano_semestre_ira',$ano_semestre_ira);

    // foreach ($dados_bancarios_usuario as $key => $value) {
    //     $tpl->setVariable($key,'value="'.$value.'"');    
    // }
    
    return $tpl;

}

function carrega_mensagem_erro(){
    
    GLOBAL $PATH_TEMPLATES;
    
    $tpl = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tpl->loadTemplatefile("error.tpl");
    
    return $tpl;

}

function carrega_mensagem_sucesso(){
    
    GLOBAL $PATH_TEMPLATES;
    
    $tpl = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tpl->loadTemplatefile("success.tpl");
    
    return $tpl;

}

function array_sanitize(&$item){

    $item = htmlentities(strip_tags(trim($item)));

}

function sanitize($data){

    return htmlentities(strip_tags(trim($data)), ENT_QUOTES, "UTF-8");

}

function sanitiza_dados_pessoais($dados_pessoais){

    array_walk($dados_pessoais, 'array_sanitize');

    $dados_pessoais['cpf'] = retorna_somente_numeros($dados_pessoais['cpf']);
    $dados_pessoais['cep'] = retorna_somente_numeros($dados_pessoais['cep']);

    return $dados_pessoais;
}

function sanitiza_dados($dados_bancarios){

    array_walk($dados_bancarios, 'array_sanitize');

    return $dados_bancarios;

}

function protect_page(){

    if (logged_in() === false) {

        $http = new HTTP2();
        $http->redirect("index.php");
        // echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";
        exit();
    }
}
function carrega_area_aluno(){
    
    $http = new HTTP2();
    $http->redirect("aluno.php");
    // echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=aluno.php'>";
}

function carrega_area_coordenador(){
    
    $http = new HTTP2();
    $http->redirect("coordenador.php");
    // echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=coordenador.php'>";
}

function mostra_erros($errors){

    $output = array();

    foreach ($errors as $error) {
        $output[] = '<li>'.$error.'</li>';
    }

    return '<ul>'.implode('', $output).'</ul>';
}

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

    $monitoria_ativa = retorna_monitoria_ativa();

    $id_monitoria_ativa = $monitoria_ativa['id_monitoria'];

    $query_retorna_disciplinas = "SELECT codigo,nome FROM disciplinas_mat INNER JOIN disciplinas_disponiveis ON codigo= codigo_disciplina AND id_monitoria=:id_monitoria";
    $stmt = $PDO->prepare( $query_retorna_disciplinas );

    $stmt->bindParam(':id_monitoria',$id_monitoria_ativa);
    
    $result = $stmt->execute();
    $rows = [];
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}



// function pega_horario_monitoria(){
    
//     GLOBAL $PDO;

//     $query_retorna_horarios_monitoria = "SELECT id_horario,horario_monitoria,dia_semana FROM disponibilidade_horario_monitoria";
//     $stmt = $PDO->prepare( $query_retorna_horarios_monitoria );
//     // $stmt->bindParam( ':id_aluno', $id_aluno );
//     // $stmt->bindParam( ':id_agenda', $id_agenda );
//     $result = $stmt->execute();
//     $rows = [];
//     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     return $rows;
// }

// function pega_dias_semana(){
    
//     GLOBAL $PDO;

//     $query_retorna_dias_semana = "SELECT DISTINCT horario_monitoria, dia_semana FROM disponibilidade_horario_monitoria ORDER BY horario_monitoria";
//     $stmt = $PDO->prepare( $query_retorna_dias_semana );
    
//     $result = $stmt->execute();
//     $rows = [];
//     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     print_r($rows);

//     return $rows;
// }

function pega_horas_semana(){
    
    GLOBAL $PDO;

    $query_retorna_dias_semana = "SELECT horario_monitoria FROM disponibilidade_horario_monitoria GROUP BY horario_monitoria";
    $stmt = $PDO->prepare( $query_retorna_dias_semana );
    
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

    $monitorias_ativas = pega_disciplinas_monitoria();
    

    for ($i=0; $i < $numero_escolhas_possiveis; $i++) { 

        $tpl -> setCurrentBlock("escolhas_possiveis");
        $tpl->setVariable('monitorias_disponiveis', '<option selected="selected" value="disciplina_vazia">Selecione a disciplina</option>');
        $tpl -> parseCurrentBlock("escolhas_possiveis");

        foreach ($monitorias_ativas as $key) {

            $tpl -> setCurrentBlock("escolhas_possiveis");
            $tpl->setVariable('monitorias_disponiveis', '<option value="'.$key['codigo'].'">'.$key['nome'].'</option>');
            $tpl -> parseCurrentBlock("escolhas_possiveis");

        }
            
        // for ($l=date('Y'); $l > date('Y') - 5; $l--) { 
        //     $tpl -> setCurrentBlock("anos_possiveis");
        //     $tpl->setVariable('ano_cursou_disciplina', '<option value="'.$l.'">'.$l.'</option>');
        //     $tpl -> parseCurrentBlock("anos_possiveis");
        // }

        $monitoria_escolhas['escolha_aluno'] = 'escolha_aluno_'.$i;
        $monitoria_escolhas['mencao_aluno'] = 'mencao_aluno_'.$i;
        // $monitoria_escolhas['ano_cursado'] = 'ano_cursado_'.$i;
        // $monitoria_escolhas['semestre_cursado'] = 'semestre_cursado_'.$i;

        $tpl -> setCurrentBlock("numero_escolhas");
        $tpl->setVariable($monitoria_escolhas);
        $tpl -> parseCurrentBlock("numero_escolhas");

    }    
    
    $array_horarios_disponiveis = array('12:00 às 13:00','13:00 às 14:00','18:00 às 19:00');

    for ($i=0; $i < sizeof($array_horarios_disponiveis); $i++) { 
        $tpl -> setCurrentBlock("cabecalho_hora");
        $tpl->setVariable('cabecalho_hora', $array_horarios_disponiveis[$i]);
        $tpl -> parseCurrentBlock("cabecalho_hora");
    }

    $array_dias_semana = array('Segunda-Feira','Terça-Feira','Quarta-Feira','Quinta-Feira','Sexta-Feira');


    for ($i=0; $i < sizeof($array_dias_semana); $i++) {
        $tpl -> setCurrentBlock("dia_semana");
        $tpl->setVariable(array('dia_semana' => $array_dias_semana[$i],'nome_hora_monitoria' =>'nome_hora_monitoria_'.$i,'id_hora_1' => $array_dias_semana[$i].'_'.$array_horarios_disponiveis[0], 'id_hora_2' =>$array_dias_semana[$i].'_'.$array_horarios_disponiveis[1], 'id_hora_3' =>$array_dias_semana[$i].'_'.$array_horarios_disponiveis[2]));
        $tpl -> parseCurrentBlock("dia_semana");
        
    }

    // $monitoria_horarios = pega_horario_monitoria();

    // $i=0;
    // foreach ($monitoria_horarios as $key) {
        // $tpl -> setCurrentBlock("dia_semana");
        // $tpl->setVariable(array('nome_hora_monitoria_1' => 'nome_hora_monitoria_'.$i,
        //     'id_hora_1' => $key['id_horario']));
        // $tpl->setVariable(array('nome_hora_monitoria_2' => 'nome_hora_monitoria_'.($i+1),
        //     'id_hora_2' => $key['id_horario']));
        // $tpl->setVariable(array('nome_hora_monitoria_3' => 'nome_hora_monitoria_'.($i+2),
        //     'id_hora_3' => $key['id_horario']));
        // $tpl -> parseCurrentBlock("dia_semana");
    //     $i+3;
    // }

    return $tpl;
}

function carrega_template_login_registro(){

    GLOBAL $PATH_TEMPLATES;
    GLOBAL $numero_escolhas_possiveis;

    $tpl = new HTML_Template_Sigma($PATH_TEMPLATES);

    $tpl->loadTemplatefile("login_registrar.tpl");

    if (autoriza_inscricao()) {
        
        $tpl->setVariable('desativa_registro','');

    }else{
        $tpl->setVariable('desativa_registro','disabled="disabled"');
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
    GLOBAL $errors;

    $conta_presenca = array_count_values($disciplinas_escolhidas);

    if (array_key_exists('disciplina_vazia', $conta_presenca) AND $conta_presenca['disciplina_vazia'] === $numero_escolhas_possiveis) {
        $errors[] = "Você deve escolher pelo menos uma disciplina para a monitoria.";
    }

    for ($i=0; $i < $numero_escolhas_possiveis; $i++) { 
        if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia' AND $disciplinas_escolhidas['mencao_aluno_'.$i] === 'mencao_vazia') {
            $errors[] = "Você não selecionou a Menção que obteve na disciplina ".$disciplinas_escolhidas['escolha_aluno_'.$i].".";
        }
        // }else if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia' AND $disciplinas_escolhidas['ano_cursado_'.$i] === 'ano_vazio') {
        //     $errors[] = "Você não selecionou o Ano que cursou disciplina ".$disciplinas_escolhidas['escolha_aluno_'.$i].".";
        // }else if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia' AND $disciplinas_escolhidas['semestre_cursado_'.$i] === 'semestre_vazio') {
        //     $errors[] = "Você não selecionou o Semestre que cursou disciplina ".$disciplinas_escolhidas['escolha_aluno_'.$i].".";
        // }
    }

    $escolheu_hora = horarios_escolhidos_candidato($disciplinas_escolhidas);

    if (empty($escolheu_hora)) {
        $errors[] = "Você deve escolher pelo menos um horário para a monitoria.";
    }

    if (empty($disciplinas_escolhidas['monitor_projeto'])) {
        $errors[] = "Você deve informar se participa de algum projeto de monitoria.";
    }

    if (empty($disciplinas_escolhidas['tipo_monitoria'])) {
        $errors[] = "Você deve informar o tipo de monitoria.";
    }

    if ($disciplinas_escolhidas['monitor_projeto']==='sim' AND $disciplinas_escolhidas['tipo_monitoria']!='somentevoluntaria') {
        $errors[] = "Como você já participa de um projeto de monitoria, você somente pode se candidatar para a monitoria voluntária.";
    }

    if ($disciplinas_escolhidas['monitor_projeto']==='sim' AND empty($disciplinas_escolhidas['nome_professor'])) {
        $errors[] = "Por favor informe o nome do professor.";
    }


    return $errors;
}

function valida_usuario_registrar(){

    GLOBAL $errors;

    $required_fields = array('nome', 'username', 'email','confirm-email','password', 'confirm-password');
    
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields)) {
            $errors[] = "Os campos marcados com asterisco devem ser preenchidos.";
            break 1;
        }
    }

    if ($_POST['username'] !="" AND !is_numeric($_POST['username'])) {
        $errors[] = "Você deve informar somente os números da sua matrícula.";
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Você deve informar um e-mail válido.";
    }

    if (!filter_var($_POST['confirm-email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Você deve informar um e-mail válido.";
    }

    if (!strcmp($_POST['email'],$_POST['confirm-email'])==0) {
        $errors[] = "Você deve informar o mesmo e-mail.";
    }

    if ($_POST['password'] !="" AND !(strlen($_POST['password']) > 7)) {
        $errors[] = "A senha deve conter pelo menos 8 caracteres.";
    }else{
        if (!strcmp($_POST['password'],$_POST['confirm-password'])==0) {
            $errors[] = "As senhas informadas não conferem.";
        }
    }

    return $errors;
}

function valida_dados_pessoais(){

    GLOBAL $errors;

    $required_fields = array('nome', 'numerorg', 'emissorrg','cpf','endereco', 'cidade', 'cep', 'estado', 'telefone', 'celular');
    
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields)) {
            $errors[] = "Os campos marcados com asterisco devem ser preenchidos.";
            break 1;
        }
    }

    if ($_POST['cpf'] !="" AND !is_numeric($_POST['cpf'])) {
        $errors[] = "Você deve informar somente os números do seu CPF.";
    }

    if (!valida_CPF($_POST['cpf'])) {
        $errors[] = "O CPF informado é inválido.";
    }

    if ($_POST['cep'] !="" AND !is_numeric($_POST['cep'])) {
        $errors[] = "Você deve informar somente os números do seu CEP.";
    }

    if ($_POST['telefone'] !="" AND !is_numeric($_POST['telefone'])) {
        $errors[] = "Você deve informar somente os números do seu telefone.";
    }

    if ($_POST['celular'] !="" AND !is_numeric($_POST['celular'])) {
        $errors[] = "Você deve informar somente os números do seu celular.";
    }
    

    return $errors;
}

function valida_dados_configuracao(){

    GLOBAL $errors;

    $required_fields = array('inicio_inscricao', 'fim_inscricao');
    
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields)) {
            $errors[] = "Os campos marcados com asterisco devem ser preenchidos.";
            break 1;
        }
    }

    if (!isset($_POST['escolhas_coordenador'])) {
        $errors[] = "Você deve escolher pelo menos uma disciplina para a monitoria.";
    }

    if (!isset($_POST['semestre'])) {
        $errors[] = "Você deve escolher o semestre da monitoria.";
    }

    if ($_POST['inicio_inscricao'] === $_POST['fim_inscricao']) {
        $errors[] = "A data de início e fim das inscrições não podem ser iguais.";
    }

    if ($_POST['inicio_inscricao'] > $_POST['fim_inscricao']) {
        $errors[] = "A data de início é maior que a data de finalização das inscrições.";
    }

    return $errors;
}

function valida_dados_bancarios(){

    GLOBAL $errors;

    $required_fields = array('nomebanco', 'numerobanco', 'agenciabancaria','numerocontacorrente');
    
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields)) {
            $errors[] = "Os campos marcados com asterisco devem ser preenchidos.";
            break 1;
        }
    }

    return $errors;

}

function valida_dados_academicos(){

    GLOBAL $errors;

    $ira = str_replace(',', '.', $_POST['ira']);
    
    $required_fields = array('ira', 'curso_graduacao');
    

    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields)) {
            $errors[] = "Os campos marcados com asterisco devem ser preenchidos.";
            break 1;
        }
    }

    if (!is_numeric($ira)) {
        $errors[] = "O IRA foi informado errado.";
    }

    return $errors;

}
?>