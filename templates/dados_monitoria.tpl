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
<form action="teste.php" method="POST" class="form-group">
  <fieldset class="scheduler-border">
    <legend class="scheduler-border">Monitorias disponíveis</legend>
      <div class="form-inline">
      <!-- BEGIN numero_escolhas -->
        <div class="form-group col-xs-3">
          <label for="email">Disciplina:</label>
          <!-- BEGIN escolha_aluno -->
          <select id="id_disciplina" name="{escolha_aluno}" class="form-group">
          <!-- BEGIN escolhas_possiveis -->
          <!-- BEGIN monitorias_disponiveis -->
            {monitorias_disponiveis}
          <!-- END monitorias_disponiveis -->
          <!-- END escolhas_possiveis -->
          </select>
          <!-- BEGIN escolha_aluno -->
        </div>

        <div class="form-group col-xs-3">
        <!-- BEGIN mencao_aluno -->
          <label for="email">Menção:</label>
          <select id="id_mencao" name="{mencao_aluno}" class="form-group">
            <option value="SR">SR</option>
            <option value="II">II</option>
            <option value="MI">MI</option>
            <option value="MM">MM</option>
            <option value="MS">MS</option>
            <option value="SS">SS</option>
          </select>
        <!-- END mencao_aluno -->
        </div>

        <div class="form-group col-xs-3">
          <label for="email">Ano:</label>
          <!-- BEGIN ano_cursado -->
          <select id="id_ano" name="{ano_cursado}" class="form-group">
            <!-- BEGIN anos_possiveis -->
            <!-- BEGIN ano_cursou_disciplina -->
            {ano_cursou_disciplina}
            <!-- END ano_cursou_disciplina -->
            <!-- END anos_possiveis -->
          </select>
          <!-- END ano_cursado -->
        </div>

        <div class="form-group col-xs-3">
          <label for="email">Semestre:</label>
          <!-- BEGIN semestre_cursado -->
          <select id="id_semestre" name="{semestre_cursado}" class="form-group">
            <option value="1">1</option>
            <option value="2">2</option>
          </select>
          <!-- END semestre_cursado -->
        </div>
        <!-- END numero_escolhas -->        
      </div>
  </fieldset>

    <fieldset class="scheduler-border">
      <div class="form-horizontal">
        <legend class="scheduler-border">Tipo de Monitoria</legend>
          <div class="radio">
            <label for="somentevoluntaria">
              <input type="radio" name="tipomonitoria" id="somentevoluntaria" value="somentevoluntaria" checked="checked">
              Somente voluntária
            </label>
          </div>
          <div class="radio">
            <label for="somenteremunerada">
              <input type="radio" name="tipomonitoria" id="somenteremunerada" value="somenteremunerada">
              Somente remunerada
            </label>
          </div>
          <div class="radio">
            <label for="indiferente">
              <input type="radio" name="tipomonitoria" id="indiferente" value="indiferente">
              Indiferente
            </label>
          </div>
      </div>
    </fieldset>
    
    <fieldset class="scheduler-border">
      <div class="form-horizontal">
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
        </div>
    </fieldset>  
  

  <fieldset class="scheduler-border">
    <div class="checkbox form-horizontal">
      <label for="concordatemos">
        <input type="checkbox" name="concordatermos" id="concordatemos" value="agree">
        Declaro conhecer os critérios de participação do Programa de Monitoria de Graduação, estabelecidos pela Resolução CEPE n 008/90 de 26.10.1990, e ser conhecedor que a participação no Programa de Monitoria não estabelece nenhum vínculo empregatício.
      </label>
    </div>
  </fieldset>

  <div class="form-group">
    <div class="row">
      <div class="col-xs-6 col-xs-offset-3">
        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Enviar">
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
