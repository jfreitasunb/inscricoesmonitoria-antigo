<form action="" method="POST" class="form-group" enctype="multipart/form-data">
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
            <option selected="selected" value="mencao_vazia">Menção</option>
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
            <option selected="selected" value="ano_vazio">Ano</option>
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
            <option selected="selected" value="semestre_vazio">Semestre</option>
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
              <input type="radio" name="tipo_monitoria" id="somentevoluntaria" value="somentevoluntaria" checked="checked">
              Somente voluntária
            </label>
          </div>
          <div class="radio">
            <label for="somenteremunerada">
              <input type="radio" name="tipo_monitoria" id="somenteremunerada" value="somenteremunerada">
              Somente remunerada
            </label>
          </div>
          <div class="radio">
            <label for="indiferente">
              <input type="radio" name="tipo_monitoria" id="indiferente" value="indiferente">
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

    <div class="form-group">
                <input type="text" class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="form-control btn btn-register" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <!-- image-preview-input -->
                    <div class="form-control btn btn-register">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" accept="application/pdf, image/png, image/jpeg, image/jpg, image/gif" name="arquivo"/> <!-- rename it -->
                    </div>
                </span>
            </div>
  

  <fieldset class="scheduler-border">
    <div class="checkbox form-horizontal">
      <label for="concordatermos">
        <input type="checkbox" name="concordatermos" id="concordatermos" value="1">
        Declaro conhecer os critérios de participação do Programa de Monitoria de Graduação, estabelecidos pela Resolução CEPE n 008/90 de 26.10.1990, e ser conhecedor que a participação no Programa de Monitoria não estabelece nenhum vínculo empregatício.
      </label>
    </div>
  </fieldset>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <input type="submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Enviar">
      </div>
    </div>
  </div>
</form>