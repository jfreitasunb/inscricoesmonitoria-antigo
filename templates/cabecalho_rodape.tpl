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
    <h2 align="center">Inscrições para a Monitoria do MAT: </h2> 
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
  <!-- END url_site -->
</html>