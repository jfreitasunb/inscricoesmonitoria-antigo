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
<!-- Form Name -->
<form class="form-group">
  <fieldset class="scheduler-border">
    <legend class="scheduler-border">Monitorias disponíveis</legend>
      <div class="form-inline">
        <div class="form-group col-xs-4">
          <label for="email">Disciplina:</label>
          <select id="selectbasic" name="selectbasic" class="form-group">
            <option value="1">Option one</option>
            <option value="2">Option two</option>
          </select>
        </div>

        <div class="form-group col-xs-4">
          <label for="email">Menção:</label>
          <select id="selectbasic" name="selectbasic" class="form-group">
            <option value="1">Option one</option>
            <option value="2">Option two</option>
          </select>
        </div>

        <div class="form-group col-xs-4">
          <label for="email">Ano/Semestre:</label>
          <select id="selectbasic" name="selectbasic" class="form-group">
            <option value="1">Option one</option>
            <option value="2">Option two</option>
          </select>
        </div>

        <div class="form-group col-xs-4">
          <label for="email">Disciplina:</label>
          <select id="selectbasic" name="selectbasic" class="form-group">
            <option value="1">Option one</option>
            <option value="2">Option two</option>
          </select>
        </div>

        <div class="form-group col-xs-4">
          <label for="email">Menção:</label>
          <select id="selectbasic" name="selectbasic" class="form-group">
            <option value="1">Option one</option>
            <option value="2">Option two</option>
          </select>
        </div>

        <div class="form-group col-xs-4">
          <label for="email">Ano/Semestre:</label>
          <select id="selectbasic" name="selectbasic" class="form-group">
            <option value="1">Option one</option>
            <option value="2">Option two</option>
          </select>
        </div>

        <div class="form-group col-xs-4">
          <label for="email">Disciplina:</label>
          <select id="selectbasic" name="selectbasic" class="form-group">
            <option value="1">Option one</option>
            <option value="2">Option two</option>
          </select>
        </div>

        <div class="form-group col-xs-4">
          <label for="email">Menção:</label>
          <select id="selectbasic" name="selectbasic" class="form-group">
            <option value="1">Option one</option>
            <option value="2">Option two</option>
          </select>
        </div>

        <div class="form-group col-xs-4">
          <label for="email">Ano/Semestre:</label>
          <select id="selectbasic" name="selectbasic" class="form-group">
            <option value="1">Option one</option>
            <option value="2">Option two</option>
          </select>
        </div>
      </div>
  </fieldset>

  <div class="form-horizontal">
    <fieldset class="scheduler-border">
      <legend class="scheduler-border">Tipo de Monitoria</legend>
        <div class="radio">
          <label for="somentevoluntaria">
            <input type="radio" name="somentevoluntaria" id="somentevoluntaria" value="somentevoluntaria" checked="checked">
            Somente voluntária
          </label>
        </div>
        <div class="radio">
          <label for="somenteremunerada">
            <input type="radio" name="somenteremunerada" id="somenteremunerada" value="somenteremunerada">
            Somente remunerada
          </label>
        </div>
        <div class="radio">
          <label for="indiferente">
            <input type="radio" name="indiferente" id="indiferente" value="indiferente">
            Indiferente
          </label>
        </div>
        </div>
    </fieldset>
    
    <fieldset class="scheduler-border">
      <legend class="scheduler-border">Horários possíveis</legend>
      <!-- BEGIN horarios_disponiveis -->
      <div class="checkbox">
        <label for="checkbox_hora_monitoria">
        <!-- BEGIN nome_hora_monitoria -->
        <!-- BEGIN id_hora -->
        <!-- BEGIN horario_monitoria -->
          <input type="checkbox" name="{nome_hora_monitoria}" id="checkbox_hora_monitoria" value="{id_hora}">
          {horario_monitoria}
        <!-- END nome_hora_monitoria -->
        <!-- END id_hora -->
        <!-- END horario_monitoria -->
        </label>
      </div>
      <!-- END horarios_disponiveis -->
    </fieldset>  
  </div>

  <fieldset class="scheduler-border">
    <div class="checkbox form-horizontal">
      <label for="concordancia">
        <input type="checkbox" name="concordancia" id="concordancia" value="agree" required="required">
        Declaro conhecer os critérios de participação do Programa de Monitoria de Graduação, estabelecidos pela Resolução CEPE n 008/90 de 26.10.1990, e ser conhecedor que a participação no Programa de Monitoria não estabelece nenhum vínculo empregatício.
      </label>
    </div>
  </fieldset>
</div>

  <div class="form-group">
    <div class="row">
      <div class="col-xs-6 col-xs-offset-3">
        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrar">
      </div>
    </div>
  </div>
</form>

</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../jquery/jquery-3.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/monitoria.js"></script>
</html>
