<form action="coordenador_configura_monitoria.php" method="POST">

<div class="container">
  <legend>Configurar período da abertura da inscrição</legend>
    <div class="row">
        <div class='col-xs-4'>
            <div class="form-group form-inline">
                <label for="">Início da Inscríção:</label>
                <div class='input-group date' id='inicio_inscricao'>
                    <input type='text' class="form-control" name="inicio_inscricao"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class='col-xs-4'>
            <div class="form-group form-inline">
                <label for="">Final da Inscríção:</label>
                <div class='input-group date' id='fim_inscricao'>
                    <input type='text' class="form-control" name="fim_inscricao"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
          <div class="form-group form-inline">
          <label for="">Semestre: </label>
            <input type="radio" name="semestre" class="radio" value="1"> 1
            <input type="radio" name="semestre" class="radio" value="2"> 2
          </div>
        </div>
    </div>
</div>

<div class="container">
  <legend>Escolher disciplinas disponíveis para a Monitoria</legend>
  <div class="row">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Disponível</th>
        <th>Disciplina</th>
        <th>Disponível</th>
        <th>Disciplina</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type="checkbox" name="escolhas_coordenador[]" class="checkbox" value="Cálculo 1"> </td>
        <td>Nome disciplina</td>
        <td><input type="checkbox" name="escolhas_coordenador[]" class="checkbox" value="Cálculo 1"></td>
        <td>Nome disciplina</td>
      </tr>
    </tbody>
  </table>
</div>

<div id="hidden_form_container" style="display:none;"></div>
<div class="container">
  <div class="row">
    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-3">
          <input type="submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Entrar">
        </div>
    </div>
  </div>
</div>

</form>

<div id="result"></div>