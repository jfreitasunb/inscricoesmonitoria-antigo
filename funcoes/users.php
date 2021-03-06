<?php
function inscricao_finalizada(){

    GLOBAL $PDO;

    $id_user        = $_SESSION['id_user'];
    $id_monitoria   = $_SESSION['id_monitoria'];

    $query_verifica_finalizacao = "SELECT finaliza_escolhas FROM finaliza_escolhas WHERE id_user=:id_user AND id_monitoria=:id_monitoria";

    $stmt = $PDO->prepare($query_verifica_finalizacao);

    $stmt->bindParam(':id_user',$id_user);
    $stmt->bindParam(':id_monitoria',$id_monitoria);

    $result = $stmt->execute();

    $finalizado = $stmt->fetchColumn();

    return $finalizado;

}

function retorna_id_user_from_username($username){

    GLOBAL $PDO;

    $query_select_id_user = "SELECT id_user FROM users where login=:login";

    $stmt = $PDO -> prepare($query_select_id_user);

    $stmt -> bindParam('login', $username);

    $result = $stmt->execute();

    $id_user = $stmt->fetchColumn();

    return $id_user;
}

function grava_dados_basicos_usuario($id_user,$nome){

    GLOBAL $PDO;

    $id_user = (int)$id_user;

    $query_insere_nome_usuario = "INSERT INTO dados_pessoais (id_user,nome) VALUES(:id_user,:nome)";

    $stmt = $PDO->prepare( $query_insere_nome_usuario );

    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':nome', $nome);

    try{
        $result = $stmt->execute();
    }
    catch( PDOException $e ){
        if (strpos($e, 'users_email_key') !== FALSE){
            $errors[] = "Já existe um usuário cadastrado com esse e-mail.";
        }
        if (strpos($e, 'users_login_ke') !== FALSE){
            $errors[] = "Já existe um usuário cadastrado com essa matrícula.";
        }
        if (strpos($e, 'duplicate key value ') !== FALSE){
            $errors[] = "Já existe um usuário cadastrado.";
        }
    }

    $query_insere_registro_banco = "INSERT INTO dados_bancarios (id_user) VALUES(:id_user)";

    $stmt2 = $PDO->prepare( $query_insere_registro_banco );

    $stmt2->bindParam(':id_user', $id_user);
    
    $result = $stmt2->execute();

    $finaliza_escolhas = 0;

    $query_insere_registro_finaliza = "INSERT INTO finaliza_escolhas (id_user,finaliza_escolhas) VALUES(:id_user,:finaliza_escolhas)";

    $stmt3 = $PDO->prepare( $query_insere_registro_finaliza );

    $stmt3->bindParam(':id_user', $id_user);
    $stmt3->bindParam(':finaliza_escolhas', $finaliza_escolhas);
    
    $result = $stmt3->execute();
    
}

function grava_disciplinas_disponiveis($id_monitoria_ativa,$escolhas_coordenador){

    GLOBAL $PDO;
    GLOBAL $errors;

    $id_monitoria = (int)$id_monitoria_ativa;

    $query_insere_disciplinas = "INSERT INTO disciplinas_disponiveis (id_monitoria,codigo_disciplina) VALUES(:id_monitoria,:codigo_disciplina)";

    $stmt = $PDO->prepare( $query_insere_disciplinas );

    $stmt->bindParam(':id_monitoria', $id_monitoria);
    foreach ($escolhas_coordenador as $key => &$value) {
        if ($value <> '') {
            $stmt->bindParam(':codigo_disciplina', $value);
        }
        $result = $stmt->execute();

        if (!$result) {
            $errors[] = 'Houve um erro durante a configuração das disciplinas. Tente novamente depois.';
        }
    }

    return $errors;

}


function grava_datas_monitoria($datas_monitoria){

    GLOBAL $PDO;

    $inicio = DateTime::createFromFormat('d/m/Y', $datas_monitoria['inicio_inscricao']);
    $fim = DateTime::createFromFormat('d/m/Y', $datas_monitoria['fim_inscricao']);
    
    $data_inicio = $inicio->format('Y-m-d');
    $data_fim = $fim->format('Y-m-d');

    $ano = $inicio->format('Y');
    $semestre_monitoria = $datas_monitoria['semestre'];
    
    $query_insere_datas_monitoria = "INSERT INTO configura_monitoria (ano_monitoria,semestre_monitoria,inicio_inscricao,fim_inscricao) VALUES(:ano_monitoria,:semestre_monitoria,:inicio_inscricao,:fim_inscricao)";


    $stmt = $PDO->prepare( $query_insere_datas_monitoria );

    $stmt->bindParam(':ano_monitoria', $ano);
    $stmt->bindParam(':semestre_monitoria', $semestre_monitoria);
    $stmt->bindParam(':inicio_inscricao', $data_inicio);
    $stmt->bindParam(':fim_inscricao', $data_fim);

    $result = $stmt->execute();

    if ($result) {
        return 1;
    }else{
        return 0;
    }
}

function grava_atuacao_anterior($id_user,$atuou_monitoria){

    GLOBAL $PDO;
    GLOBAL $errors;

    $query_insere_atuacao = "INSERT INTO atuou_monitoria (id_user,atuou_disciplina) VALUES(:id_user,:atuou_disciplina)";

    $stmt_atuacao = $PDO->prepare( $query_insere_atuacao );

    $stmt_atuacao->bindParam(':id_user', $id_user);

    foreach ($atuou_monitoria as $key => &$value) {
        $stmt_atuacao -> bindParam(':atuou_disciplina', $value); 
        
        $result = $stmt_atuacao->execute();

        if (!$result) {
            $errors[] = "Houve um erro na hora de grava as informações sobre sua atuação em monitoria anteriormente. Tente novamente mais tarde.";
        }
    }

    return $errors;

}

function grava_dados_pessoais_usuario($id_user,$id_monitoria,$dados_pessoais, $tabela){

    GLOBAL $PDO;
    GLOBAL $errors;


    $query_procura_dados_usuario = "SELECT COUNT(*) from $tabela where id_user=:id_user and id_monitoria=:id_monitoria";

    $procura_dados_usuario = $PDO->prepare($query_procura_dados_usuario);

    $procura_dados_usuario -> bindParam(':id_user', $id_user);
    $procura_dados_usuario -> bindParam(':id_monitoria', $id_monitoria);

    $procura_dados_usuario->execute();

    $rowCount = $procura_dados_usuario->fetchColumn();

    if ($rowCount == 0) {
        
        $query_insere_registro_banco = "INSERT INTO $tabela (id_user,id_monitoria) VALUES(:id_user,:id_monitoria)";

        $stmt2 = $PDO->prepare( $query_insere_registro_banco );

        $stmt2->bindParam(':id_user', $id_user);
        $stmt2->bindParam(':id_monitoria', $id_monitoria);
    
        $result = $stmt2->execute();
    }else{
        $keys_update = array_keys($dados_pessoais);
        $campos_update = "";

        foreach ($keys_update as $key) {
            $campos_update .= $key.'=:'.$key.', ';
        }

        $campos_update = rtrim($campos_update, ", ");

        $campos = implode(', ', array_keys($dados_pessoais));

        $query_update_dados_usuario = "UPDATE $tabela SET $campos_update  WHERE id_user=:id_user and id_monitoria=:id_monitoria";
        
        $stmt = $PDO->prepare( $query_update_dados_usuario );

        $stmt -> bindParam(':id_user', $id_user);
        $stmt -> bindParam(':id_monitoria', $id_monitoria);

        foreach ($dados_pessoais as $key => &$value) {
            $stmt -> bindParam(':'.$key, $value);   
        }
    
        try{
            $result = $stmt->execute();
        }
        catch( PDOException $e ){
            if (strpos($e, 'users_email_key') !== FALSE){
                $errors[] = "Já existe um usuário cadastrado com esse e-mail.";
            }
            if (strpos($e, 'users_login_key') !== FALSE){
                $errors[] = "Já existe um usuário cadastrado com essa matrícula.";
            }
        }
    }

    return $errors;

}

function processa_login(){
    $errors = valida_usuario_login();

    if (empty($errors)) {
        $username = sanitize($_POST['username']);
        $password = trim($_POST['password']);
        if (login_existe($username)){
            $dados_usuario = retorna_dados_usuario($username);
            if ($dados_usuario['ativo'] == 0){
                $errors[] = "Você não ativou sua conta ainda. Verifique se recebeu um e-mail com o link de ativação de conta.";
            }else if (password_verify($password,$dados_usuario['password'])) {
                $_SESSION['id_user'] = $dados_usuario['id_user'];
                $_SESSION['login'] = $dados_usuario['login'];
                $_SESSION['email'] = $dados_usuario['email'];
                $_SESSION['user_type'] = $dados_usuario['user_type'];
                $_SESSION['ativo'] = $dados_usuario['ativo'];

                $dados_monitoria_ativa = retorna_monitoria_ativa();

                $_SESSION['id_monitoria'] = $dados_monitoria_ativa['id_monitoria'];

                if ($dados_usuario['user_type'] === 0) {
                    carrega_area_aluno();
                }else if ($dados_usuario['user_type'] === 1) {
                    carrega_area_coordenador();
                }else if ($dados_usuario['user_type'] === 2){
                    carrega_area_administrador();
                }
            }else{
                $errors[] = "Login ou senha não conferem.";
            }
        }
    }else{
        if(isset($errors)){
                    return $errors;
                }
    }
    return $errors;
}

function user_data($id_user,$tabela){

    GLOBAL $PDO;
    
    $data = array();
    $id_user = (int)$id_user;
    $tabela_dados = $tabela;

    $func_num_args = func_num_args();
    $func_get_args = func_get_args();

    if ($func_num_args > 1) {
        
        unset($func_get_args[0]);
        unset($func_get_args[1]);
        $campos = implode(', ', $func_get_args);
    }

    $query_recupera_dados_usuario = "SELECT $campos FROM $tabela_dados  WHERE id_user=:id_usuario";

    $stmt = $PDO->prepare( $query_recupera_dados_usuario );

    $stmt -> bindParam(':id_usuario', $id_user);
        
    $result = $stmt->execute();

    $data = $stmt -> fetch(PDO::FETCH_ASSOC);

    return $data;

}

function logged_in(){

    $tabela_dados = 'users';

    if (isset($_SESSION['id_user'])){

        $dados_usuario = user_data($_SESSION['id_user'],$tabela_dados, 'login', 'email', 'user_type', 'ativo');

        if ($_SESSION['login'] === $dados_usuario['login'] && $_SESSION['email'] === $dados_usuario['email'] && $_SESSION['user_type'] === $dados_usuario['user_type'] AND $_SESSION['ativo'] === $dados_usuario['ativo']) {
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }

}

function login_existe($username){
    GLOBAL $PDO;

    $login = $username;

    $query_busca_usuario = "SELECT * FROM users WHERE login=:login";

    $stmt = $PDO->prepare( $query_busca_usuario);

    $stmt -> bindParam(':login', $login);

    $stmt->execute();

    $linhas = $stmt->fetchAll();

    return count($linhas);

}

function retorna_dados_usuario($username){

    GLOBAL $PDO;

    $login = $username;

    $query_busca_usuario = "SELECT * FROM users WHERE login=:login";

    $stmt = $PDO->prepare( $query_busca_usuario);

    $stmt -> bindParam(':login', $login);
    
    $stmt->execute();
    $dados_usuario_login = $stmt->fetch(PDO::FETCH_ASSOC);

    return $dados_usuario_login;

}

function valida_usuario_login(){

    GLOBAL $errors;

    $required_fields = array('username', 'password');
    
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields)) {
            $errors[] = "Os campos marcados com asterisco devem ser preenchidos.";
            break 1;
        }
    }

    // if (!is_numeric($_POST['username'])) {
    //     $errors[] = "Você deve informar somente os números da sua matrícula.";
    // }

    return $errors;
}

function ativar_email($email, $email_code){

    GLOBAL $PDO;

    $email = trim(strtolower($email));
    $email_code = trim($email_code);

    $query_busca_codigo = "SELECT * FROM users WHERE email=:email AND validation_code=:validation_code AND ativo=0";

    $stmt = $PDO->prepare( $query_busca_codigo );

    $stmt -> bindParam(':email', $email);
    $stmt -> bindParam(':validation_code', $email_code);

    $stmt->execute();

    $linhas = $stmt->fetchAll();

    if (count($linhas)) {
        $query_ativa_conta = "UPDATE users SET ATIVO=1 WHERE email=:email AND validation_code=:validation_code";

        $stmt = $PDO->prepare( $query_ativa_conta );

        $stmt -> bindParam(':email', $email);
        $stmt -> bindParam(':validation_code', $email_code);

        $result = $stmt->execute();

        if ($result) {
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function email_exists($email){

    GLOBAL $PDO;

    $query_seleciona_email = "SELECT * FROM users WHERE email=:email AND ATIVO=0";

    $stmt = $PDO->prepare( $query_seleciona_email );

    $stmt -> bindParam(':email', $email);

    $result = $stmt->execute();

    $rowCount = count($stmt->fetchAll());
    return $rowCount;
}

function envia_email_ativa_conta($nome,$email,$validation_code){

    GLOBAL $SITE_INSCRICAO_MONITORIA;
    $mail = new PHPMailer();

    $email_host = "127.0.0.1";//endereco do servidor smtp
    $email_from = "posgrad@mat.unb.br";

    $mail->isSMTP();
    $link_ativacao = $SITE_INSCRICAO_MONITORIA."activate.php?email=".$email."&email_code=".$validation_code;

    $texto="<div>
    Prezado(a) ".$nome.",</div>
<div>
    Sua conta foi criada com sucesso.</div>
<div>
    Antes de fazer o login você precisa ativar sua conta entrando no link: <a href='".$link_ativacao."' target='_blank'>".$link_ativacao."</a> 
<div>
    Coordenação de Graduação do MAT-UnB.</div>
";
    $texto=wordwrap($texto,70);

    $texto = mb_convert_encoding($texto,'ISO-8859-1','UTF-8');

    $subject = "Inscricões na Monitoria do MAT/UnB: ativação de conta";

    $subject = mb_convert_encoding($subject,'ISO-8859-1','UTF-8');

    $reply_to = mb_convert_encoding("Graduação MAT/UnB",'ISO-8859-1','UTF-8');

    $mail = new PHPMailer(); // defaults to using php "mail()"

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $email_host;

    $mail->Charset = 'UTF-8';

    $mail->AddReplyTo($email_from,$reply_to);

    $mail->SetFrom($email_from);

    $mail->AddAddress($email, $nome);

    $mail->Subject    = $subject;

    $mail->MsgHTML($texto);

    if(!$mail->Send()) {
        $devolve="problema no envio de mensagens";
    } else {
        $devolve="mensagem enviada";
    }

    return $devolve;
}
function prepara_dados(){
    
    GLOBAL $STRING_VALIDA_EMAIL;

    $login = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $dados = array();

    $dados['login'] = trim($_POST['username']);
    $dados['email'] = trim($_POST['email']);
    $dados['password'] = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $dados['validation_code'] = md5($STRING_VALIDA_EMAIL.$_POST['email'].date("d-m-Y H:i:s:u"));
    $dados['ativo'] = 0;

    return $dados;

}

function grava_dados_bancarios_usuario($id_user,$dados_bancarios){

    GLOBAL $PDO;

    $campos = "id_user, ";

    $campos .= implode(', ', array_keys($dados_bancarios));

    $bind_valores = ":id_user, ";

    $bind_valores .= ':' . implode(', :', array_keys($dados_bancarios));

    $query_insere_dados_bancarios = "INSERT INTO dados_bancarios ($campos) VALUES($bind_valores)";

    $stmt = $PDO->prepare( $query_insere_dados_bancarios );

    $stmt -> bindParam(':id_user', $id_user);

    foreach ($dados_bancarios as $key => &$value) {
        $stmt -> bindParam(':'.$key, $value);
    }

    $result = $stmt->execute();
    
    if ($result) {
        return 1;
    }else{
        return 0;
    }
}


function grava_usuario_novo($dados_usuario){
    
    GLOBAL $PDO;
    GLOBAL $errors;

    $campos = implode(', ', array_keys($dados_usuario));
    $bind_valores = ':' . implode(', :', array_keys($dados_usuario));

    $query_insere_novo_usuario = "INSERT INTO users ($campos) VALUES($bind_valores)";

    $stmt = $PDO->prepare( $query_insere_novo_usuario );


    foreach ($dados_usuario as $key => &$value) {
        $stmt -> bindParam(':'.$key, $value);   
    }
      
    try{
        $result = $stmt->execute();
    }
    catch( PDOException $e ){
        if (strpos($e, 'users_email_key') !== FALSE){
            $errors[] = "Já existe um usuário cadastrado com esse e-mail.";
        }
        if (strpos($e, 'users_login_key') !== FALSE){
            $errors[] = "Já existe um usuário cadastrado com essa matrícula.";
        }
    }

    return $errors;

}

function upload_historico($id_user){

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
                $nome_final = md5("historico_".$id_user).".".$extensao;
            }else{
                $nome_final = $_FILES['arquivo']['name'];
            }
            
            if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'].$nome_final)){
                $errors[] = "N&atilde;o foi poss&iacute;vel enviar o arquivo, tente novamente mais tarde.";
            }else{
                $query_insere_historico = "INSERT INTO arquivos_enviados (id_user,nome_arquivo,data_envio) VALUES(:id_user, :nome_arquivo, :data)";
                $stmt = $PDO->prepare( $query_insere_historico );
                echo $id_user;
                $stmt -> bindParam(':id_user', $id_user);
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

function grava_escolhas_monitoria($id_user, $id_monitoria,$disciplinas_escolhidas){
    
    GLOBAL $PDO;
    GLOBAL $numero_escolhas_possiveis;
    GLOBAL $errors;

    $campos = 'id_user, escolha_aluno, mencao_aluno, id_monitoria';

    $bind_valores = ':id_user, :escolha_aluno, :mencao_aluno, :id_monitoria';

    $escolheu_hora = horarios_escolhidos_candidato($disciplinas_escolhidas);

    $query_insere_escolha_aluno = "INSERT INTO escolhas_candidatos ($campos) VALUES($bind_valores)";
    
    $stmt_escolhas_aluno = $PDO->prepare( $query_insere_escolha_aluno );

    $stmt_escolhas_aluno -> bindParam(':id_user', $id_user);
    $stmt_escolhas_aluno -> bindParam(':id_monitoria', $id_monitoria);

    for ($i=0; $i < $numero_escolhas_possiveis; $i++) {
        if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia') {
            
            $stmt_escolhas_aluno -> bindParam(':escolha_aluno', $disciplinas_escolhidas['escolha_aluno_'.$i]);
            $stmt_escolhas_aluno -> bindParam(':mencao_aluno', $disciplinas_escolhidas['mencao_aluno_'.$i]);
            
            $result = $stmt_escolhas_aluno->execute();

            if (!$result) {
                $errors[] = "Erro durante a gravação da escolha.".($i+1);
            }
        }
    }

    $campos_horas = 'id_user, horario_monitoria, dia_semana, id_monitoria';

    $bind_valores_horas = ':id_user, :horario_monitoria, :dia_semana, :id_monitoria';

    $query_insere_escolha_horas = "INSERT INTO horario_escolhido_monitoria ($campos_horas) VALUES($bind_valores_horas)";
    
    $stmt_horas = $PDO->prepare( $query_insere_escolha_horas );

    $stmt_horas -> bindParam(':id_user', $id_user);
    $stmt_horas -> bindParam(':id_monitoria', $id_monitoria);

    foreach ($escolheu_hora as $key => &$value) {
        $hora_escolhida = explode('_',$disciplinas_escolhidas[$value]);
        $horario_monitoria = sanitize($hora_escolhida[0]);
        $dia_semana = sanitize($hora_escolhida[1]);
        $stmt_horas -> bindParam(':horario_monitoria', $horario_monitoria);
        $stmt_horas -> bindParam(':dia_semana', $dia_semana);
        
        $result = $stmt_horas->execute();

            if (!$result) {
                $errors[] = "Erro durante a gravação da escolha do horário.";
            }

    }

    $campos_update = 'id_user=:id_user, tipo_monitoria=:tipo_monitoria,concordatermos=:concordatermos, id_monitoria=:id_monitoria';
 
    $query_insere_dados_finais = "UPDATE finaliza_escolhas SET $campos_update WHERE id_user=:id_user";
     
    $stmt_dados_finais = $PDO->prepare( $query_insere_dados_finais );
    $stmt_dados_finais -> bindParam(':id_user', $id_user);
    $stmt_dados_finais -> bindParam(':tipo_monitoria', $disciplinas_escolhidas['tipo_monitoria']);
    $stmt_dados_finais -> bindParam(':concordatermos', $disciplinas_escolhidas['concordatermos']);
    $stmt_dados_finais -> bindParam(':id_monitoria', $id_monitoria);

    $result = $stmt_dados_finais->execute();

    if (!$result) {
        $errors[] = "Não foi possível finalizar suas escolhas.";
    }

    return $errors;
}

function grava_monitor_convidado($id_user,$id_monitoria){

    GLOBAL $PDO;
    GLOBAL $errors;

    $monitor_convidado  = $_POST['monitor_projeto'];
    $nome_professor     = sanitize($_POST['nome_professor']);

    $query_monitor_projeto = "UPDATE dados_academicos SET monitor_convidado=:monitor_convidado, nome_professor=:nome_professor WHERE id_user=:id_user AND id_monitoria=:id_monitoria";

    $stmt_monitor_projeto = $PDO->prepare( $query_monitor_projeto );

    $stmt_monitor_projeto->bindParam(':id_user', $id_user);
    $stmt_monitor_projeto->bindParam(':id_monitoria', $id_monitoria);
    $stmt_monitor_projeto->bindParam(':monitor_convidado', $monitor_convidado);
    $stmt_monitor_projeto->bindParam(':nome_professor', $nome_professor);

    $result = $stmt_monitor_projeto->execute();

    if (!$result) {
        $errors = "Não foi possível gravar as informações sobre participação em projeto. Tente novamente mais tarde.";
    }

    // try{
    //     $result = $stmt_monitor_projeto->execute();
    // }
    // catch( PDOException $e ){
    //     print_r($e);
    // }

    return $errors;
}

function finaliza_escolhas($id_user, $id_monitoria,$disciplinas_escolhidas){

    GLOBAL $PDO;
    GLOBAL $errors;
 
    $campos_update = 'id_user=:id_user, tipo_monitoria=:tipo_monitoria, monitor_projeto=:monitor_projeto, nome_professor=:nome_professor,concordatermos=:concordatermos, id_monitoria=:id_monitoria';
 
    $query_insere_escolha_finais = "UPDATE finaliza_escolhas SET $campos_update WHERE id_user=:id_user";
     
    $stmt = $PDO->prepare( $query_insere_escolha_finais );
    $stmt -> bindParam(':id_user', $id_user);
    $stmt -> bindParam(':tipo_monitoria', $disciplinas_escolhidas['tipo_monitoria']);
    $stmt -> bindParam(':monitor_projeto', $disciplinas_escolhidas['monitor_projeto']);

    $stmt -> bindParam(':nome_professor', $disciplinas_escolhidas['nome_professor']);
    $stmt -> bindParam(':concordatermos', $disciplinas_escolhidas['concordatermos']);
    $stmt -> bindParam(':id_monitoria', $id_monitoria);

    $result = $stmt->execute();

    if (!$result) {
        $errors[] = "Não foi possível finalizar suas escolhas.";
    }

    return $errors;
}

function finaliza_inscricao($id_user, $id_monitoria){

    GLOBAL $PDO;
    GLOBAL $errors;

    $query_seleciona_tipo_monitoria = "SELECT tipo_monitoria FROM finaliza_escolhas WHERE id_user=:id_user AND id_monitoria=:id_monitoria";

    $stmt_tipo_monitoria = $PDO->prepare( $query_seleciona_tipo_monitoria );

    $stmt_tipo_monitoria -> bindParam(':id_user', $id_user);
    $stmt_tipo_monitoria -> bindParam(':id_monitoria', $id_monitoria);

    $result = $stmt_tipo_monitoria->execute();

    $tipo_monitoria = $stmt_tipo_monitoria->fetchColumn();

    if ($tipo_monitoria !== "somentevoluntaria") {
        
        $dados_bancarios = user_data($id_user,'dados_bancarios','nome_banco','numero_banco','agencia_bancaria','numero_conta_corrente');

        foreach ($dados_bancarios as $key) {
            if ($key === null) {
                $errors[] = "Você não informou todos os dados bancários necessários.";
            }
        }  
    }

    $dados_academicos_candidato = user_data($id_user,'dados_academicos','ira','monitor_convidado','nome_professor','curso_graduacao');

    if ($dados_academicos_candidato['ira'] === null) {
        $errors[] = "Você não informou seu IRA.";
    }

    if ($dados_academicos_candidato['monitor_convidado'] === 'sim' AND strlen($dados_academicos_candidato['nome_professor']) == 0) {
        $errors[] = "Você não informou o nome do professor responsável por sua monitoria.";
    }

    if (strlen($dados_academicos_candidato['curso_graduacao']) == 0) {
        $errors[] = "Você não informou seu curso de graduação.";
    }

    $query_historico_enviado = "SELECT data_envio FROM arquivos_enviados WHERE id_user=:id_user ORDER BY data_envio DESC LIMIT 1";
    

    $stmt_historico_enviado = $PDO->prepare( $query_historico_enviado );

    $stmt_historico_enviado -> bindParam(':id_user', $id_user);
    
    $result = $stmt_historico_enviado->execute();

    $data_historico_recente = $stmt_historico_enviado->fetchColumn();

    var_dump($data_historico_recente);

    $historico_recente = DateTime::createFromFormat('Y-m-d H:i:s', $data_historico_recente);
    
    $data = $historico_recente->format('d/m/Y');

    $data_hoje = new DateTime;
    
    $validade = $data_hoje->diff($historico_recente);

    if ($validade->format('%m') > 4) {
        $errors = "Envie um histórico atualizado.";
    }
    

    if (empty($errors)) {
        
        $query_finaliza_inscricao = "UPDATE finaliza_escolhas SET finaliza_escolhas='TRUE' WHERE id_user=:id_user AND id_monitoria=:id_monitoria";
     
        $stmt_finaliza_inscricao = $PDO->prepare( $query_finaliza_inscricao );
        $stmt_finaliza_inscricao -> bindParam(':id_user', $id_user);
        $stmt_finaliza_inscricao -> bindParam(':id_monitoria', $id_monitoria);
        $result = $stmt_finaliza_inscricao->execute();

        if (!$result) {
            $errors[] = "Não foi possível finalizar sua inscrição. Tente novamente mais tarde.";
        }

    }
    
    return $errors;
}

?>