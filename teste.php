<?php
require_once "config/init.php";
include_once "funcoes/general.php";
$teste = pega_horario_monitoria();
print_r($teste);
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
        for ($i=0; $i < 3; $i++) { 
        echo "<th>".$i."</th>";
        }
        ?>   
        </tr>
      </thead>
      <tbody>
        <?php 
        for ($j=0; $j < 6; $j++) { 
        echo '<tr>
        <td></td><td scope="row">' . $j. '</td>
        <td>' . ($j+1) .'</td>
        <td> '.($j+2) .'</td>
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
