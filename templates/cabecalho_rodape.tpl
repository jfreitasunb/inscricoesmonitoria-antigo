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
<body>
<div class="container">
  <div class="jumbotron">
    <h1 align="center">Departamento de Matemática</h1> 
    <!-- BEGIN periodo_inscricao -->
    <h2 align="center">Inscrições para a Monitoria do MAT: {periodo_inscricao}</h2> 
    <!-- END periodo_inscricao -->
  </div>
</div>
<div class="exibir_mensagem">
  <!-- BEGIN exibe_mensagens -->
    {exibe_mensagens}
  <!-- END exibe_mensagens -->
</div>

<div class="exibe-menus">
  <!-- BEGIN exibe_menus -->
    {exibe_menus}
  <!-- END exibe_menus --> 
</div>

<div class="exibe_paginas">
  <!-- BEGIN exibe_paginas -->
  {exibe_paginas}
  <!-- END exibe_paginas -->
</div>

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
</html>