<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6">
                <!-- BEGIN ativa_formulario_login -->
              <a href="#" {ativa_formulario_login} id="login-form-link">Login</a>
                <!-- END ativa_formulario_login -->
            </div>
            <div class="col-xs-6">
                <!-- BEGIN ativa_formulario_registro -->
              <a href="#" {ativa_formulario_registro} id="register-form-link">Registrar</a>
                <!-- END ativa_formulario_registro -->
            </div>
            <hr>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <!-- BEGIN tipo_estilo_login -->
              <form id="login-form" action="" method="post" role="form" {tipo_estilo_login}>
                <!-- END tipo_estilo_login -->
                <div class="form-group">
                  <div class="required-field-block">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Matrícula" value="">
                      <div class="required-icon">
                        <div class="text">*</div>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="required-field-block">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Senha">
                    <div class="required-icon">
                      <div class="text">*</div>
                    </div>
                  </div>
                  <div class="col-xs-12" style="height:20px;"></div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name = "login" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Entrar">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="text-center">
                          <a href="#" tabindex="5" class="forgot-password">Esqueceu a senha?</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
                <!-- BEGIN tipo_estilo_registro -->
              <form id="register-form" action="" method="post" role="form" {tipo_estilo_registro}>
                <!-- END tipo_estilo_registro -->
                <div class="form-group">
                  <!-- BEGIN desativa_registro-->
                  <input type="text" name="nome" id="nome" tabindex="1" class="form-control" placeholder="Nome" required="required" value="" {desativa_registro}>
                </div>
                <div class="form-group">
                  <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Matrícula" required="required" value="" {desativa_registro}>
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" required="required" value="" {desativa_registro}>
                </div>
                <div class="form-group">
                  <input type="email" name="confirm-email" id="confirm-email" tabindex="1" class="form-control" placeholder="Confirmar Email" required="required" value="" {desativa_registro}>
                </div>
                <div class="form-group">
                  <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Senha" required="required" {desativa_registro}>
                </div>
                <div class="form-group">
                  <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirmar Senha" required="required" {desativa_registro}>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                      <input type="submit" name="registrar" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrar" {desativa_registro}>
                    </div>
                    <!-- END desativa_registro -->
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>