<?php
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
    $menu_aluno['escolher_monitoria'] = 'aluno_escolher_monitoria.php';
    $menu_aluno['dados_bancarios'] = 'aluno_dados_bancarios';

    foreach ($menu_aluno as $key => $value) {
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

    $tpl->loadTemplatefile("dados_bancarios.tpl");
    
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

function sanitiza_dados_bancarios($dados_bancarios){

    array_walk($dados_bancarios, 'array_sanitize');

    return $dados_bancarios;

}

function protect_page(){

    if (logged_in() === false) {
        echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";
        exit();
    }
}
function carrega_area_aluno(){
    
    echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=aluno.php'>";
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

    $query_retorna_disciplinas = "SELECT id_monitoria,nome_disciplina FROM disciplinas_disponiveis";
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
        }else if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia' AND $disciplinas_escolhidas['ano_cursado_'.$i] === 'ano_vazio') {
            $errors[] = "Você não selecionou o Ano que cursou disciplina ".$disciplinas_escolhidas['escolha_aluno_'.$i].".";
        }else if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia' AND $disciplinas_escolhidas['semestre_cursado_'.$i] === 'semestre_vazio') {
            $errors[] = "Você não selecionou o Semestre que cursou disciplina ".$disciplinas_escolhidas['escolha_aluno_'.$i].".";
        }
    }

    $escolheu_hora = horarios_escolhidos_candidato($disciplinas_escolhidas);

    if (empty($escolheu_hora)) {
        $errors[] = "Você deve escolher pelo menos um horário para a monitoria.";
    }

    if (empty($disciplinas_escolhidas['concordatermos'])) {
        $errors[] = "Você deve concordar com os termos da monitoria.";
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

    if (!($_POST['email'] === $_POST['confirm-email'])) {
        $errors[] = "Você deve informar o mesmo e-mail.";
    }

    if ($_POST['password'] !="" AND !(strlen($_POST['password']) > 7)) {
        $errors[] = "A senha deve conter pelo menos 8 caracteres.";
    }else{
        if (!($_POST['password'] === $_POST['confirm-password'])) {
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

function valida_dados_bancarios(){

    GLOBAL $errors;

    $required_fields = array('nomebanco', 'numerobanco', 'agenciabancaria','nomerocontacorrente');
    
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields)) {
            $errors[] = "Os campos marcados com asterisco devem ser preenchidos.";
            break 1;
        }
    }

    return $errors;

}
?>