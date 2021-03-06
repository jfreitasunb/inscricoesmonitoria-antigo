<div class="container">
    <form action="" method="POST" class="form-group" enctype="multipart/form-data">
      <fieldset class="scheduler-border">
        <!-- BEGIN ano_semestre_ira -->
        <legend class="scheduler-border">IRA atualizado ({ano_semestre_ira})</legend>
        <!-- END ano_semestre_ira -->
        <div class="form-horizontal">
          <div class="row">
            <div class="col-md-4 form-group">
              <input id="ira" name="ira" type="text" class="form-control" required="required">
            </div>
          </div>
        </div>
      </fieldset>

      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Curso de Graduação</legend>
        <div class="form-horizontal">
        <div class="row">
            <div class="radio">
             <input type="hidden" name="curso_graduacao" id="curso_graduacao" value="">
            </div>
          </div>
          <div class="row">
            <div class="radio">
              <label><input type="radio" name="curso_graduacao" id="curso_graduacao" value="matematica">Matemática (Bacharelado/Licenciatura)</label>
            </div>
          </div>
          <div class="row">
            <div class="radio">
              <label><input type="radio" name="curso_graduacao" id="curso_graduacao" value="computacao">Ciências da Computação (Bacharelado/Licenciatura)</label>
            </div>
          </div>
          <div class="row">
            <div class="radio">
              <label><input type="radio" name="curso_graduacao" id="curso_graduacao" value="estatistica">Estatística</label>
            </div>
          </div>
          <div class="row">
            <div class="radio">
              <label><input type="radio" name="curso_graduacao" id="curso_graduacao" value="fisica">Física (Bacharelado/Licenciatura)</label>
            </div>
          </div>
          <div class="row">
            <div class="radio">
              <label><input type="radio" name="curso_graduacao" id="curso_graduacao" value="quimica">Química (Bacharelado/Licenciatura)</label>
            </div>
          </div>
          <div class="row">
            <div class="radio">
              <label><input type="radio" name="curso_graduacao" id="curso_graduacao" value="geologia_geofisica">Geologia/Geofísica</label>
            </div>
          </div>
          <div class="row">
            <div class="radio">
              <label><input type="radio" name="curso_graduacao" id="curso_graduacao" value="engenharia">Engenharia (Mecânica/Elétrica/Civil/Redes/Mecatrônica/Química/Produção)</label>
            </div>
          </div>
          <div class="row">
            <div class="radio">
              <label><input type="radio" name="curso_graduacao" id="curso_graduacao" value="outros">Outros</label>
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
              <label><input type="checkbox" name="checkbox_foi_monitor[]" id="checkbox_foi_monitor" value="ial_algebra-linear">Sim, de Introdução à Álgebra Linear ou Álgebra Linear</label>
            </div>
          </div>
          <div class="row">
            <div class="checkbox">
              <label><input type="checkbox" name="checkbox_foi_monitor[]" id="checkbox_foi_monitor" value="outras">Sim, de outras disciplinas</label>
            </div>
          </div>
          <div class="row">
            <div class="checkbox">
              <label><input type="checkbox" name="checkbox_foi_monitor[]" id="checkbox_foi_monitor" value="nao">Não</label>
            </div>
          </div>
        </div>
      </fieldset>

      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Histórico</legend>
        <div class="form-horizontal">
          <div class="row">
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