<div class="container">

    <form action="" method="POST" class="form-group" enctype="multipart/form-data">
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">IRA atualizado (incluindo 02/16)</legend>
        <div class="form-horizontal">
          <div class="row">
            <label class="col-md-4 control-label" for="ira">IRA</label>  
            <div class="col-md-4">
              <input id="ira" name="ira" type="text" class="form-control input-md" required="required">
            </div>
          </div>
        </div>
      </fieldset>

      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Você já foi monitor de disciplinas do Departamento de Matemática?</legend>
        <div class="form-horizontal">
          <div class="row">
            <div class="checkbox">
              <label><input type="checkbox" name="checkbox_foi_monitor[]" id="checkbox_foi_monitor" value="calculo1_matematica1">Sim, de Cálculo 1 ou Matemática 1</label>
            </div>
          </div>
          <div class="row">
            <div class="checkbox">
              <label><input type="checkbox" name="checkbox_foi_monitor[]" id="checkbox_foi_monitor" value="calculo2_matematica_2">Sim, de Cálculo 2 ou Matemática 2</label>
            </div>
          </div>
          <div class="row">
            <div class="checkbox">
              <label><input type="checkbox" name="checkbox_foi_monitor[]" id="checkbox_foi_monitor" value="calculo3">Sim, de Cálculo 3</label>
            </div>
          </div>
          <div class="row">
            <div class="checkbox">
              <label><input type="checkbox" name="checkbox_foi_monitor[]" id="checkbox_foi_monitor" value="outras">Sim, de Introdução à Álgebra Linear ou Álgebra Linear</label>
            </div>
          </div>
          <div class="row">
            <div class="checkbox">
              <label><input type="checkbox" name="checkbox_foi_monitor[]" id="checkbox_foi_monitor" value="nao">Sim, de outras disciplinas</label>
            </div>
          </div>
          <div class="row">
            <div class="checkbox">
              <label><input type="checkbox" name="checkbox_foi_monitor" id="checkbox_foi_monitor" value="">Não</label>
            </div>
          </div>
        </div>
      </fieldset>

      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Você será monitor de um projeto de monitoria específico?</legend>
        <h4>Atenção: Apenas marque SIM se você foi convidado por um professor.</h4>
        <div class="form-horizontal">
          <div class="row">
            <div class="radio">
              <label for="convidado">
                <input type="radio" name="convidado" id="convidado" value="nao">
                Não
              </label>
            </div>
          </div>
          <div class="row">
            <div class="radio">
              <label for="convidado">
                <input type="radio" name="convidado" id="convidado" value="sim">
                Sim. Por favor, digite abaixo o nome do professor que será responsável por sua monitoria. Neste caso, apenas será possível matrícula na opção de monitoria voluntária.
              </label>
            </div>
          </div>
          <div class="row">
            <h4>Caso tenha respondido "SIM" à questão anterior, escreva o nome do professor que será responsável por sua monitoria.</h4>
            <div class="col-md-4">
              <input id="nome_professor" name="nome_professor" type="text" class="form-control input-md" required="required">
            </div>
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