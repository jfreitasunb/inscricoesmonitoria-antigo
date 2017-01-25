<?php
function activate($email, $email_code){

    GLOBAL $PDO;

    $email = trim(strtolower($email));
    $email_code = trim($email_code);

    $query_busca_codigo = "SELECT * FROM users WHERE email=:email AND validation_code=:validation_code AND ativo=FALSE";

    $stmt = $PDO->prepare( $query_busca_codigo );

    $stmt -> bindParam(':email', $email);
    $stmt -> bindParam(':validation_code', $email_code);

    $stmt->execute();

    $linhas = $stmt->fetchAll();

    if (count($linhas)) {
        $query_ativa_conta = "UPDATE users SET ATIVO=TRUE WHERE email=:email AND validation_code=:validation_code";

        $stmt = $PDO->prepare( $query_ativa_conta );

        $stmt -> bindParam(':email', $email);
        $stmt -> bindParam(':validation_code', $email_code);

        $result = $stmt->execute();

        if ($result) {
            return 1;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

function email_exists($email){

    GLOBAL $PDO;

    $query_seleciona_email = "SELECT * FROM users WHERE email=:email AND is_active=FALSE";

    $stmt = $PDO->prepare( $query_seleciona_email );

    $stmt -> bindParam(':email', $email);

    $result = $stmt->execute();

    $rowCount = $stmt->rowCount();
    return $rowCount;
}

function envia_email_ativa_conta($nome,$email,$validation_code){
    require_once "../lib/PHPMailer/PHPMailerAutoload.php";
    $mail = new PHPMailer();

    $email_host = "127.0.0.1";//endereco do servidor smtp
    $email_from = "posgrad@mat.unb.br";

    $mail->isSMTP();
    $link_ativacao = "http://localhost:8080/monitoriamat/actions/activate.php?email=".$email."&email_code=".$validation_code;

    $texto="<div>
    Prezado(a) ".$nome.",</div>
<div>
    Sua conta foi criada com sucesso.</div>
<div>
    Antes de fazer o login você precisa ativar sua conta entrando no link:<a href='".$link_ativacao."' target='_blank'>".$link_ativacao."</a> 
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
    $dados['is_active'] = 0;

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