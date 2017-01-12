<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/css_monitoria.css" rel="stylesheet">
  
</head>
<body>
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Dados Pessoais</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="numerorg">RG</label>  
  <div class="col-md-4">
  <input id="numerorg" name="numerorg" type="text" class="form-control input-md" required="required">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="emissorrg">Órgão Emissor</label>  
  <div class="col-md-4">
  <input id="emissorrg" name="emissorrg" type="text" class="form-control input-md" required="required">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cpf">CPF</label>  
  <div class="col-md-4">
  <input id="cpf" name="cpf" type="text" placeholder="Somente números" class="form-control input-md" required="required">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="endereco">Endereço</label>  
  <div class="col-md-4">
  <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cidade">Cidade</label>  
  <div class="col-md-4">
  <input id="cidade" name="cidade" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cep">CEP</label>  
  <div class="col-md-4">
  <input id="cep" name="cep" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="estado">Estado</label>  
  <div class="col-md-4">
  <input id="estado" name="estado" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="telefone">Telefone</label>  
  <div class="col-md-4">
  <input id="telefone" name="telefone" type="text" placeholder="(DD)#######" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="celular">Celular</label>  
  <div class="col-md-4">
  <input id="celular" name="celular" type="text" placeholder="(DD)#######" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">Enviar</button>
  </div>
</div>

</fieldset>
</form>

</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../jquery/jquery-3.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/monitoria.js"></script>
</html>
