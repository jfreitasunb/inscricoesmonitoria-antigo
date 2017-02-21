<div class="container">
  <div class="row">
    <form class="form-horizontal" action="" method="post">
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Dados Pessoais</legend>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="nome">Nome</label>  
            <div class="col-md-4">
              <!-- BEGIN nome -->
              <input id="nome" name="nome" type="text" class="form-control input-md" required="required" {nome}>
              <!-- END nome -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="numerorg">RG</label>  
            <div class="col-md-4">
              <!-- BEGIN numerorg -->
              <input id="numerorg" name="numerorg" type="text" class="form-control input-md" required="required" {numerorg}>
              <!-- END numerorg -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="emissorrg">Órgão Emissor</label>  
            <div class="col-md-4">
              <!-- BEGIN emissorrg -->
              <input id="emissorrg" name="emissorrg" type="text" class="form-control input-md" required="required" {emissorrg}>
              <!-- END emissorrg -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="cpf">CPF</label>  
            <div class="col-md-4">
              <!-- BEGIN cpf -->
              <input id="cpf" name="cpf" type="text" placeholder="Somente números" class="form-control input-md" required="required" {cpf}>
              <!-- END cpf -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="endereco">Endereço</label>  
            <div class="col-md-4">
              <!-- BEGIN endereco -->
              <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md" required="" {endereco}>
              <!-- END endereco -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="cidade">Cidade</label>  
            <div class="col-md-4">
              <!-- BEGIN cidade -->
              <input id="cidade" name="cidade" type="text" placeholder="" class="form-control input-md" required="" {cidade}>
              <!-- END cidade -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="cep">CEP</label>  
            <div class="col-md-4">
              <!-- BEGIN cep -->
              <input id="cep" name="cep" type="text" placeholder="" class="form-control input-md" required="" {cep}>
              <!-- END cep -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="estado">Estado</label>  
            <div class="col-md-4">
              <!-- BEGIN estado -->
              <input id="estado" name="estado" type="text" placeholder="" class="form-control input-md" required="" {estado}>
              <!-- END estado -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="telefone">Telefone</label>  
            <div class="col-md-4">
              <!-- BEGIN telefone -->
              <input id="telefone" name="telefone" type="text" placeholder="(DD)#######" class="form-control input-md" required="" {telefone}>
              <!-- END telefone -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-4 control-label" for="celular">Celular</label>  
            <div class="col-md-4">
              <!-- BEGIN celular -->
              <input id="celular" name="celular" type="text" placeholder="(DD)#######" class="form-control input-md" required="" {celular}>
              <!-- END celular -->
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <input type="submit" name="registrar" id="register-submit" class="btn btn-primary" tabindex="4" value="Enviar" {desativa_registro}>
            </div>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>