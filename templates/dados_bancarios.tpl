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
<legend>Dados Bancários</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nomebanco">Banco</label>  
  <div class="col-md-4">
  <input id="nomebanco" name="nomebanco" type="text" class="form-control input-md" required="required">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="numerobanco">Número do banco</label>  
  <div class="col-md-4">
  <input id="numerobanco" name="numerobanco" type="text" class="form-control input-md" required="required">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="agenciabancaria">Agência</label>  
  <div class="col-md-4">
  <input id="agenciabancaria" name="agenciabancaria" type="text" placeholder="" class="form-control input-md" required="required">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nomerocontacorrente">Conta corrente</label>  
  <div class="col-md-4">
  <input id="nomerocontacorrente" name="nomerocontacorrente" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cidade">Cidade</label>  
  <div class="col-md-4">
  <input id="cidade" name="cidade" type="text" placeholder="" class="form-control input-md" required="">
    
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
