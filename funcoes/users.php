<?php
function retorna_id_user_from_username($username){

    GLOBAL $PDO;

    $query_select_id_user = "SELECT id_user FROM user where login=:login";

    $stmt = $PDO -> prepare($query_select_id_user);

    $stmt -> bindParam('login', $username);

    $result = $stmt->execute();

    $id_user = $stmt->fetchAll();

    print_r($id_user);


}


function grava_nome_usuario($id_user,$nome){

    GLOBAL $PDO;

    $query_insere_nome_usuario = "INSERT INTO dados_pessoais (id_user,nome) VALUES(:id_user,:nome)";

    $stmt2 = $PDO->prepare( $query_insere_nome_usuario );

    $stmt2 -> bindParam(':id_user', $id_user);
    $stmt2 -> bindParam(':nome', $nome);

    $result = $stmt2->execute(); 
    
}

function grava_dados_pessoais_usuario($dados_pessoais){

    GLOBAL $PDO;

    $func_get_args = func_get_args();

    $campos = implode(', ', $func_get_args);
    
    $query_ativa_conta = "UPDATE dados_pessoais_usuario SET  WHERE id_user=:id_user ";
    

    $stmt = $PDO->prepare( $query_recupera_dados_usuario );

    $stmt -> bindParam(':id_usuario', $id_user);
        
    $result = $stmt->execute();

    $data = $stmt -> fetch(PDO::FETCH_ASSOC);


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

                if ($dados_usuario['user_type'] === 3) {
                    carrega_area_aluno();
                }else if ($dados_usuario['user_type'] === 2) {
                    carrega_area_coordenador();
                }else if ($dados_usuario['user_type'] === 1){
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

    if (!is_numeric($_POST['username'])) {
        $errors[] = "Você deve informar somente os números da sua matrícula.";
    }

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
        if (strpos($e, 'users_login_ke') !== FALSE){
            $errors[] = "Já existe um usuário cadastrado com essa matrícula.";
        }
    }

    return $errors;

}

function upload_historico($id_candidato){

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
                $nome_final = md5("historico_".$id_candidato).".".$extensao;
            }else{
                $nome_final = $_FILES['arquivo']['name'];
            }
            
            if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'].$nome_final)){
                $errors[] = "N&atilde;o foi poss&iacute;vel enviar o arquivo, tente novamente";
            }else{
                $query_insere_historico = "INSERT INTO arquivos_enviados (id_candidato,nome_arquivo,data_envio) VALUES(:id_candidato, :nome_arquivo, :data)";
                $stmt = $PDO->prepare( $query_insere_historico );
                echo $id_candidato;
                $stmt -> bindParam(':id_candidato', $id_candidato);
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

function grava_escolhas_monitoria($id_candidato, $ano_monitoria, $semestre_monitoria,$disciplinas_escolhidas){
    
    GLOBAL $PDO;
    GLOBAL $numero_escolhas_possiveis;

    $campos = 'id_candidato, escolha_aluno, mencao_aluno, ano_cursado, semestre_cursado, ano_monitoria_ativa, semestre_monitoria_ativa';

    $bind_valores = ':id_candidato, :escolha_aluno, :mencao_aluno, :ano_cursado, :semestre_cursado, :ano_monitoria_ativa, :semestre_monitoria_ativa';

    $ano_monitoria_ativa = $ano_monitoria;
    $semestre_monitoria_ativa = $semestre_monitoria;
    $escolheu_hora = horarios_escolhidos_candidato($disciplinas_escolhidas);

    $gravou = array();

    for ($i=0; $i < $numero_escolhas_possiveis; $i++) { 
        if ($disciplinas_escolhidas['escolha_aluno_'.$i] !== 'disciplina_vazia') {
            
            $query_insere_escolha_aluno = "INSERT INTO escolhas_candidatos ($campos) VALUES($bind_valores)";
            
            $stmt = $PDO->prepare( $query_insere_escolha_aluno );
            $stmt -> bindParam(':id_candidato', $id_candidato);
            $stmt -> bindParam(':escolha_aluno', $disciplinas_escolhidas['escolha_aluno_'.$i]);
            $stmt -> bindParam(':mencao_aluno', $disciplinas_escolhidas['mencao_aluno_'.$i]);
            $stmt -> bindParam(':ano_cursado', $disciplinas_escolhidas['ano_cursado_'.$i]);
            $stmt -> bindParam(':semestre_cursado', $disciplinas_escolhidas['semestre_cursado_'.$i]);
            $stmt -> bindParam(':ano_monitoria_ativa', $ano_monitoria_ativa);
            $stmt -> bindParam(':semestre_monitoria_ativa', $semestre_monitoria_ativa);
            $result = $stmt->execute();

            if ($result) {
                $gravou[] = 1;
            }else{
                $gravou[] = 0;
            }
        }
    }

    return $gravou;
}

function finaliza_escolhas($id_candidato, $ano_monitoria_ativa, $semestre_monitoria_ativa,$disciplinas_escolhidas){

    GLOBAL $PDO;
    GLOBAL $errors;

    $escolheu_hora = horarios_escolhidos_candidato($disciplinas_escolhidas);
    $hora_escolhida ="";
    foreach ($escolheu_hora as $key) {
        $hora_escolhida .= $disciplinas_escolhidas[$key];
    }
 
    $finaliza_escolhas = TRUE;
 
    $campos_finais = 'id_candidato, tipo_monitoria, hora_escolhida, concordatermos, ano_monitoria_ativa, semestre_monitoria_ativa, finaliza_escolhas';
 
    $bind_valores_finais = ':id_candidato, :tipo_monitoria, :hora_escolhida, :concordatermos, :ano_monitoria_ativa, :semestre_monitoria_ativa, :finaliza_escolhas';
 
    $query_insere_escolha_finais = "INSERT INTO finaliza_escolhas ($campos_finais) VALUES($bind_valores_finais)";
     
    $stmt = $PDO->prepare( $query_insere_escolha_finais );
    $stmt -> bindParam(':id_candidato', $id_candidato);
    $stmt -> bindParam(':tipo_monitoria', $disciplinas_escolhidas['tipo_monitoria']);
    $stmt -> bindParam(':hora_escolhida', $hora_escolhida);
    $stmt -> bindParam(':concordatermos', $disciplinas_escolhidas['concordatermos']);
    $stmt -> bindParam(':ano_monitoria_ativa', $ano_monitoria_ativa);
    $stmt -> bindParam(':semestre_monitoria_ativa', $semestre_monitoria_ativa);
    $stmt -> bindParam(':finaliza_escolhas', $finaliza_escolhas);
    $result = $stmt->execute();

    if (!$result) {
        $errors[] = "Não foi possível finalizar suas escolhas.";
    }

    return $errors;
}

?>