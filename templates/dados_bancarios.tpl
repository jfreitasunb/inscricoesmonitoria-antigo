<div class="container">
  <div class="row">
    <form class="form-horizontal" action="" method="post">
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Dados Bancários</legend>
        
        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="nome_banco">Banco</label>  
            <div class="col-md-4">
              <!-- BEGIN nome_banco -->
              <input id="nome_banco" name="nome_banco" type="text" class="form-control input-md" required="required" {nome_banco}>
              <!-- END nome_banco -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="numero_banco">Número do banco</label>  
            <div class="col-md-4">
              <!-- BEGIN numero_banco -->
              <input id="numero_banco" name="numero_banco" type="text" class="form-control input-md" required="required" {numero_banco}>
              <!-- END numero_banco -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="agencia_bancaria">Agência</label>  
            <div class="col-md-4">
              <!-- BEGIN agencia_bancaria -->
              <input id="agencia_bancaria" name="agencia_bancaria" type="text" placeholder="" class="form-control input-md" required="required" {agencia_bancaria}>
              <!-- END agencia_bancaria -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="numero_conta_corrente">Conta corrente</label>  
            <div class="col-md-4">
              <!-- BEGIN numero_conta_corrente -->
              <input id="numero_conta_corrente" name="numero_conta_corrente" type="text" placeholder="" class="form-control input-md" required="" {numero_conta_corrente}>    
              <!-- END numero_conta_corrente -->
            </div>
          </div>
        </div>

        <div class="col-xs-12" style="height:35px;"></div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
              <input type="submit" name="registrar" id="register-submit" class="btn btn-primary btn-lg" tabindex="4" value="Enviar" {desativa_registro}>
            </div>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>