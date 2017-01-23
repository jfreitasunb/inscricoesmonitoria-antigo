<?php
require_once "../config/init.php";
$disciplinas_escolhidas = $_POST;
 
var_dump($disciplinas_escolhidas);

var_dump($_FILES);

$errors = valida_escolhas_aluno($disciplinas_escolhidas);

$id_candidato = 1;
$ano_monitoria = '2017';
$semestre_monitoria = '1';

if (empty($errors)){
    $resultado = grava_escolhas_monitoria($id_candidato, $ano_monitoria, $semestre_monitoria,$disciplinas_escolhidas);
    
    if (in_array(0, $resultado)) {
        $errors[] = "Houve um erro na hora de gravar suas escolhas. Tente novamente mais tarde.";
    }else{
        $_UP['pasta'] = "uploads";
 
// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 5; // 2Mb
 
// Array com as extensões permitidas
$_UP['extensoes'] = array("jpg","jpeg", "pdf", "png");
     
// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
$_UP['renomeia'] = true;
 
// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'N&atilde;o houve erro';
$_UP['erros'][1] = 'O arquivo no upload &eacute; maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'N&atilde;o foi feito o upload do arquivo';


// tabela admin_anexos: id_documento, numero_anexo, nome_arquivo


    if ($_FILES['arquivo']['name']!="")
        {
        //############### CASO ESTEJA PRONTO PARA UPLOAD
        // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($_FILES['arquivo']['error'] != 0) 
            {
            $errors[] = "Não foi possível enviar seu arquivo.";
            exit; // Para a execução do script
            }
        // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
     
        // Faz a verificação da extensão do arquivo
        $extensao_00=explode(".",$_FILES['arquivo']['name']);
        $extensao=strtolower(end($extensao_00));
        if (array_search($extensao, $_UP['extensoes']) === false) 
            {
            $errors[]= "Por favor, envie arquivos com as seguintes extens&otilde;es: tex";
            }
     
        // Faz a verificação do tamanho do arquivo
            else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) 
            {
            $errors[] = "O arquivo enviado &eacute; muito grande, envie arquivos de at&eacute; 2Mb.";
            }
     
        // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
            else {
        // Primeiro verifica se deve trocar o nome do arquivo
                if ($_UP['renomeia'] == true) 
                    {
        // Cria um nome baseado na quantidade de itens armazenados: 
                    $nome_final = $aval."_cespe";
                    //echo $nome_final;
                    } else 
                    {
        // Mantém o nome original do arquivo
                    $nome_final = $_FILES['arquivo']['name'];
                    }
     
        // Depois verifica se é possível mover o arquivo para a pasta escolhida
                if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] .$nome_final.".csv")) 
                    {
        // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo; insere ponteiro na tabela
                    echo "Upload efetuado com sucesso!";
                    
                    } 
                    else 
                    {
        // Não foi possível fazer o upload, provavelmente a pasta está incorreta
                    $errors[] = "N&atilde;o foi poss&iacute;vel enviar o arquivo, tente novamente";
                    }
     
                 }
        
        }
    }
}else{
    print_r($errors);
}

print_r($errors);




     

 //Usar para processar o cadastro do candidato. 

// $campos = implode(', ', array_keys($disciplinas_escolhidas));
// $bind_valores = ':' . implode(', :', array_keys($disciplinas_escolhidas));

// $query_insere_escolha_aluno = "INSERT INTO escolhas_candidatos ($campos) VALUES($bind_valores)";

// $stmt = $PDO->prepare( $query_insere_escolha_aluno );


// foreach ($disciplinas_escolhidas as $key => &$value) {
//     $stmt -> bindParam(':'.$key, $value);   
// }
    
// $result = $stmt->execute();

// if ($result) {
//     echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
//     header("location:../index.php");
//     exit();
// }else{
//     echo "Houve um problema com a sua solicitação. Por favor tente mais tarde.";
// }


?>