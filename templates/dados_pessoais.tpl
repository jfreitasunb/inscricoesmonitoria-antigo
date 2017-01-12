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
<!-- Name Section -->
  <div class="row">
    <div class="col-md-8 col-md-offset-1">
      <form class="form-horizontal" role="form">
        <fieldset>

          <!-- Form Name -->
          <legend>Dados Pessoais</legend>

          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-4">
              <label class="col-md-4 control-label" for="textinput">RG</label> 
              <input type="text" name="numerorg" class="form-control">
            </div>
            <label class="col-md-4 control-label" for="textinput">Órgão Emissor</label> 
            <div class="col-sm-4">
              <input type="text" name="orgaoemissor" class="form-control">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-4">
              <input type="date" placeholder="Date Of Birth" class="form-control">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-4">
              <select type="gender" placeholder="Gender" class="form-control">
                <option value="female">Female</option>
                <option value="male">Male</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-4">
              <input type="checkbox" name="hasSibling" data-toggle="modal" data-target="#sibling">   Has Sibling?
            </div>
          </div>

</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../jquery/jquery-3.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/monitoria.js"></script>
</html>
