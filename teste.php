<?php
require_once "config/init.php";
include_once "funcoes/general.php";
// $teste = pega_horario_monitoria();
print_r($teste);
$horas_monitoria = pega_horas_semana();

$array_dias_semana = array('Segunda-Feira','Terça-Feira','Quarta-Feira','Quinta-Feira','Sexta-Feira');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Inscrições Monitoria do MAT/UnB</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- BEGIN url_site -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/css_monitoria.css" rel="stylesheet">
  
</head>

<table class="table table-striped">                     
    <div class="table responsive">
      <thead>
        <tr>
        <th></th>
        <?php 
        for ($i=0; $i < sizeof($horas_monitoria); $i++) { 
        echo "<th>".$horas_monitoria[$i]['horario_monitoria']."</th>";
        }
        ?>   
        </tr>
      </thead>
      <tbody>
        <?php 
        for ($j=0; $j < 1; $j++) { 
        echo '<tr>
        <td>'.$array_dias_semana[$j].'</td><td scope="row"><input type="radio" name="{nome_hora_monitoria}" id="radio_hora_monitoria" value="{id_hora}"></td>
        <td><input type="radio" name="{nome_hora_monitoria}" id="radio_hora_monitoria" value="{id_hora}"></td>
        <td> <input type="radio" name="{nome_hora_monitoria}" id="radio_hora_monitoria" value="{id_hora}"></td>
        </tr>';
        }  
        ?>
      </tbody>
    </div>
</table>

</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="jquery/jquery-3.1.1.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/monitoria.js"></script>
  

  <script type="text/javascript" src="bower_components/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="bower_components/moment/min/moment.min.js"></script>
  <script type="text/javascript" src="bower_components/moment/locale/pt-br.js"></script>
  <script type="text/javascript" src="bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
  <link rel="stylesheet" href="bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
  <script src="bower_components/moment/locale/fr.js"></script>
    

  <script type="text/javascript">
    $(function () {
        $('#inicio_inscricao').datetimepicker({
            locale: 'pt-br',
            format: 'DD/MM/YYYY'
        });
        $('#fim_inscricao').datetimepicker({
            locale: 'pt-br',
            format: 'DD/MM/YYYY'
        });
    }); 
  </script>
<script>
  $('#disciplinas').click(function() {
  var checkedStatus = this.checked;
  $('#disciplinas tbody tr').find('td :checkbox').each(function() {
    $(this).prop('checked', checkedStatus);
  });
});
</script>
</html>
