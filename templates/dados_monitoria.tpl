<div class="container">

    <form action="" method="POST" class="form-group" enctype="multipart/form-data">
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Monitorias disponíveis</legend>
        <h4 align="center">Escolha até três (03) disciplinas, em ordem de prioridade.</h4>
        <div class="form-inline">
          <div class="row">
            <!-- BEGIN numero_escolhas -->
            <div class="form-group col-xs-6">
              <label for="email">Disciplina:</label>
              <!-- BEGIN escolha_aluno -->
              <select id="id_disciplina" name="{escolha_aluno}" class="form-control">
              <!-- BEGIN escolhas_possiveis -->
              <!-- BEGIN monitorias_disponiveis -->
                {monitorias_disponiveis}
              <!-- END monitorias_disponiveis -->
              <!-- END escolhas_possiveis -->
              </select>
              <!-- END escolha_aluno -->
            </div>

            <div class="form-group col-xs-6">
              <!-- BEGIN mencao_aluno -->
              <label for="email">Menção:</label>
              <select id="id_mencao" name="{mencao_aluno}" class="form-control">
                <option selected="selected" value="mencao_vazia">Menção</option>
                <option value="SS">SS</option>
                <option value="MS">MS</option>
                <option value="MM">MM</option>
              </select>
              <!-- END mencao_aluno -->
            </div>
            <!-- END numero_escolhas -->        
          </div>
        </div>
      </fieldset>

    <fieldset class="scheduler-border">
      <legend class="scheduler-border">Tipo de Monitoria</legend>
        <div class="form-horizontal">
          <div class="row">
            <div class="radio">
              <label for="somentevoluntaria">
                <input type="radio" name="tipo_monitoria" id="somentevoluntaria" value="somentevoluntaria" checked="checked">
                Somente voluntária
              </label>
            </div>
          </div>
          
          <div class="row">
            <div class="radio">
              <label for="somenteremunerada">
                <input type="radio" name="tipo_monitoria" id="somenteremunerada" value="somenteremunerada">
                Somente remunerada
              </label>
            </div>
          </div>
          
          <div class="row">
            <div class="radio">
              <label for="indiferente">
                <input type="radio" name="tipo_monitoria" id="indiferente" value="indiferente">
                Indiferente
              </label>
            </div>
          </div>
        </div>
      </fieldset>
    
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Horários possíveis</legend>
        <div class="form-horizontal">
          <div class="row">
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
        </div>
      </fieldset>

      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Histórico</legend>
        <div class="form-horizontal">
          <div class="row">
            <input type="text" class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->
            <span class="input-group-btn">
                <!-- image-preview-clear button -->
                <button type="button" class="btn btn-primary" style="display:none;">
                    <span class="glyphicon glyphicon-remove"></span> Clear
                </button>
                <!-- image-preview-input -->
                <div class="btn btn-primary">
                    <input type="file" accept="application/pdf, image/png, image/jpeg, image/jpg, image/gif" name="arquivo"/> <!-- rename it -->
                </div>
            </span>
          </div>
        </div>
      </fieldset>
  
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Declaração de conhecimento das regras da Monitoria da UnB:</legend>
        <div class="checkbox form-horizontal">
          <div class="row">
            <label for="concordatermos">
              <input type="checkbox" name="concordatermos" id="concordatermos" value="1">
              Declaro conhecer os critérios de participação do Programa de Monitoria de Graduação, estabelecidos pela Resolução CEPE no 008/90 de 26.10.1990 (disponível online em <a href="http://tinyurl.com/hg3ch99" target="_blank">http://tinyurl.com/hg3ch99</a>), e ser conhecedor que a participação no Programa não estabelece nenhum vínculo empregatício meu junto a Fundação Universidade de Brasília – UnB.
            </label>
          </div>
        </div>
      </fieldset>

      <div class="col-xs-12" style="height:35px;"></div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
              <input type="submit" name="registrar" id="register-submit" class="btn btn-primary btn-lg" tabindex="4" value="Enviar" {desativa_registro}>
            </div>
          </div>
        </div>
    </form>
  
</div>