<!DOCTYPE html>
<html lang="en">
  <head>
    <title>food</title>
    <meta charset="utf-8" http-equiv="encoding">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="container-fluid">
          <div class="navbar-header">
            <button class="navbar-toggle collapsed" id="menu-button" type="button" data-toggle="collapse" data-target="#meni" aria-expanded="false">
              <p>MENU</p>
            </button>
          </div>
        </div>
        <div class="container collapse navbar-collapse" id="meni">
          <ul class="nav navbar-nav">
            <li class="link"><a href="index.php">Home</a></li>
          </ul>
        </div>
          <div class="nav navbar-right">
              <p>
                  <?php
                    if(!empty($msg)){
                        echo $msg;
                    }
                  ?>
              </p>
          </div>
      </div>
    </nav>
<br>
<div class="container container-fluid">
    <div class="col-md-4 col-xs-12">
        <form method="post" class="col-md-12" id="create-item">
            <h3 class="page-header">Dodavanje proizvoda</h3>
            <div class="form-group">
                <label class="control-label" for="table">vrsta proizvoda</label>
                <select class="form-control" type="text" name="table" id="create-table">
                    <option>pice</option>
                    <option>sendvici</option>
                    <option>rostilj</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="naziv">naziv</label>
                <input class="form-control" type="text" id="naziv" name="naziv"></input>
            </div>
            <div class="form-group">
                <label class="control-label" for="cena">cena</label>
                <input class="form-control" type="text" id="cena" name="cena"></input>
            </div>
            <button class="btn btn-info col-md-5" type="button" onclick="create()">Unesi</button>
        </form>
        <form method="post" class="col-md-12">
            <h3 class="page-header">Izlistavanje proizvoda</h3>
            <button type="button" class="btn btn-info col-md-5" onclick="read()">Prikazi</button>
            <div class="form-group col-md-7">
                <select class="form-control" type="text" name="table" id="read-table">
                    <option>pice</option>
                    <option>sendvici</option>
                    <option>rostilj</option>
                </select>
            </div>
        </form>
    </div>
    <div class="col-md-8 col-xs-12">
        <div id="info">
            
        </div>
        <table class="table table-striped table-responsive table-hover" id="prikaz">
        </table>
    </div>
</div>
    <!--javascipt-s-->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/ui.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>