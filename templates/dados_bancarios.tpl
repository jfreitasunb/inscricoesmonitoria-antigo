<form class="form-horizontal" action="" method="post">
  <fieldset>
    <legend>Dados Bancários</legend>

    <div class="form-group">
      <label class="col-md-4 control-label" for="nomebanco">Banco</label>  
      <div class="col-md-4">
        <!-- BEGIN nomebanco -->
        <input id="nomebanco" name="nomebanco" type="text" class="form-control input-md" required="required" {nomebanco}>
        <!-- END nomebanco -->
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="numerobanco">Número do banco</label>  
      <div class="col-md-4">
        <!-- BEGIN numerobanco -->
        <input id="numerobanco" name="numerobanco" type="text" class="form-control input-md" required="required" {numerobanco}>
        <!-- END numerobanco -->
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="agenciabancaria">Agência</label>  
      <div class="col-md-4">
        <!-- BEGIN agenciabancaria -->
        <input id="agenciabancaria" name="agenciabancaria" type="text" placeholder="" class="form-control input-md" required="required" {agenciabancaria}>
        <!-- END agenciabancaria -->
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="numerocontacorrente">Conta corrente</label>  
      <div class="col-md-4">
        <!-- BEGIN numerocontacorrente -->
        <input id="numerocontacorrente" name="numerocontacorrente" type="text" placeholder="" class="form-control input-md" required="" {numerocontacorrente}>    
        <!-- END numerocontacorrente -->
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">
        <button id="submit" name="submit" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </fieldset>
</form>