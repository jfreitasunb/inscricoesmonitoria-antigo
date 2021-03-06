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
          <legend class="scheduler-border">Você será monitor de um projeto de monitoria específico?</legend>
          <h4>Atenção: Apenas marque SIM se você foi convidado por um professor.</h4>
          <div class="form-horizontal">
            <div class="row">
              <div class="radio">
                <label for="monitor_projeto">
                  <input type="radio" name="monitor_projeto" id="monitor_projeto" value="nao">
                  Não
                </label>
              </div>
            </div>
            <div class="row">
              <div class="radio">
                <label for="monitor_projeto">
                  <input type="radio" name="monitor_projeto" id="monitor_projeto" value="sim">
                  Sim. Por favor, digite abaixo o nome do professor que será responsável por sua monitoria. Neste caso, apenas será possível matrícula na opção de monitoria voluntária.
                </label>
              </div>
            </div>
            <div class="row">
              <h4>Caso tenha respondido "SIM" à questão anterior, escreva o nome do professor que será responsável por sua monitoria.</h4>
              <div class="col-md-6">
                <input id="nome_professor" name="nome_professor" type="text" class="form-control input-md">
              </div>
            </div>
          </div>
        </fieldset>

      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Tipo de Monitoria</legend>
          <div class="form-horizontal">
            <div class="row">
              <div class="radio">
                <label for="somentevoluntaria">
                  <input type="radio" name="tipo_monitoria" id="somentevoluntaria" value="somentevoluntaria">
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
          <legend class="scheduler-border">Explicite seus dias e horários possíveis para a monitoria:</legend>
          <div class="form-horizontal">
            <div class="row">
            <!-- BEGIN horarios_disponiveis -->
              <table class="table table-striped">                     
                <div class="table responsive">
                  <thead>
                    <tr>
                    <th></th>
                    <!-- BEGIN cabecalho_hora -->
                      <th class="text-center">{cabecalho_hora}</th>
                    <!-- END cabecalho_hora -->
                    </tr>
                  </thead>
                  <tbody>
                    <!-- BEGIN dia_semana -->
                    <tr>
                      <td>{dia_semana}</td>
                      <td scope="row" class="text-center">
                        <input type="radio" name="{nome_hora_monitoria}" id="radio_hora_monitoria" value="{id_hora_1}">
                      </td>
                      <td class="text-center">
                        <input type="radio" name="{nome_hora_monitoria}" id="radio_hora_monitoria" value="{id_hora_2}">
                      </td>
                      <td class="text-center">
                        <input type="radio" name="{nome_hora_monitoria}" id="checkbox_hora_monitoria" value="{id_hora_3}">
                      </td>
                    </tr>
                    <!-- END dia_semana -->
                  </tbody>
                </div>
              </table>
            <!-- END horarios_disponiveis -->
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