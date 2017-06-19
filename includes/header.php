<!DOCTYPE html>
<html lang="en">
  <head>
    <title>food</title>
    <meta charset="utf-8" http-equiv="encoding">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <body data-spy="scroll" data-target="#meni">
    <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="400" data-offset-bottom="200">
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
                <li class="link"><a href="#home">Home</a></li>
                <li class="link"><a href="#sendvici">Sendviči</a></li>
                <li class="link"><a href="#pice">Pice</a></li>
                <li class="link"><a href="#rostilj">Roštilj</a></li>
                <li class="link"><a href="#contact">Contact</a></li>
              </ul>
              <form class="navbar-form navbar-right">
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" id="order-modal">
                      Porudzbina
                  </button>
              </form>
              <p>
                  <?php
                    echo $msg;
                  ?>
              </p>
          </div>
        </div>
      </nav>