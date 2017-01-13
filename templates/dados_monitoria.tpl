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
<legend>Dados Bancários</legend>

<form class="form-group">
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

  <div class="form-group col-xs-4 form-horizontal">
    <label class="control-label" for="tipomonitoria">Tipo de Monitoria</label>
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

  <div class="form-group col-xs-4 form-horizontal">
    <label class="control-label form-horizontal" for="horariomonitoria">Horários possíveis</label>
    <div class="checkbox">
      <label for="horariomonitoria-0">
        <input type="checkbox" name="horariomonitoria" id="horariomonitoria-0" value="12-14">
        12 às 14h
      </label>
    </div>
    <div class="checkbox">
      <label for="horariomonitoria-1">
        <input type="checkbox" name="horariomonitoria" id="horariomonitoria-1" value="18-19">
        18 às 19h
      </label>
    </div>
    <div class="checkbox">
      <label for="horariomonitoria-2">
        <input type="checkbox" name="horariomonitoria" id="horariomonitoria-2" value="aula">
        Horário normal de aula (somente para Cálculo 1)
      </label>
    </div>
  </div>

  <div class="checkbox col-xs-4 form-horizontal">
    <label for="horariomonitoria-3">
      <input type="checkbox" name="horariomonitoria" id="horariomonitoria-3" value="agree">
      Declaro conhecer os critérios de participação do Programa de Monitoria de Graduação, estabelecidos pela Resolução CEPE n 008/90 de 26.10.1990, e ser conhecedor que a participação no Programa de Monitoria não estabelece nenhum vínculo empregatício.
    </label>
  </div>
</div>

  <button type="submit" class="btn btn-default">Submit</button>
</form>

</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../jquery/jquery-3.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/monitoria.js"></script>
</html>
