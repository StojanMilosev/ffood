<?php
$msg='';
$cfg = include('includes/config.php');
//require('includes/data.php');
require('includes/mail.php');
require ('includes/crud.php');

//instanciranje konekije za bazom podataka
//$instance = ConnectDb::getInstance();
$connection = mysqli_connect($cfg->db_host,$cfg->db_username,$cfg->db_password,$cfg->db_name);//$instance->getConnection();
//instanciranje logger-a
//$logger = Logger::getInstance();

if(mysqli_connect_errno()){
       $msg = mysqli_connect_error();
    }

$crud = new Crud;

include('includes/header.php');
?>
    
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLabel">Vasa porudzbina</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body">
              <table class="table table-striped table-hover" >
                  <thead></thead>
                  <tbody id="order-table"></tbody>
              </table>                
            </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal" id="zatvor">Zatvori</button>
            <button type="button" class="btn btn-primary">Naruci</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">                          
      <div class="sec" id="home">
        <video autoplay mute loop>
          <source src="img/bbq.mp4">
        </video>
        <div class="container container-fluid">
          <div class="row" id="home-intro">
            <h1 class="col-md-3 col-xs-12 text-center">Fast Food</h1>
            <p class="col-md-9 col-xs-12 text-center">
              A single-page application (SPA) for fast food restoraunts
              Lorem ipsum dolor sit amet, consectetur adipiscing elit,                        
            </p>
          </div><br>
          <div class="row home">
            <div class="col-md-offset-1 col-md-3 col-xs-12">
                <a href="#sendvici">
                    <h2 class="text-center">Sendvici</h2>
                </a>
            </div>
            <div class="col-md-offset-1 col-md-3 col-xs-12">
                <a href="#pice">
                    <h2 class="text-center">Pice</h2>
                </a>
            </div>
            <div class="col-md-offset-1 col-md-3 col-xs-12">
                <a href="#rostilj">
                    <h2 class="text-center">Rostilj</h2>
                </a>
            </div>
          </div>
        </div><br>
      </div>
    </div>
  <div class="row">
    <div class="sec" id="sendvici">
      <div class="container container-fluid">                   
        <h1 class="text- col-md-3 col-xs-12 text-center">Sendvici</h1>
        <p class="col-md-9">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
          sed do eiusmod tempor incididunt ut labore et dolore magna 
          aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
          ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis 
          aute irure dolor in reprehenderit in voluptate velit esse cillum 
          dolore eu fugiat nulla pariatur. Excepteur int occaecat cupidatat 
          non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
        </p><br>
        <h2 class="text-center">lista</h2><br>
        <div class="col-md-offset-3 col-md-6 col-xs-12">
          <table class="table table-hover table-responsive">
                <?php
                $query = "SELECT * FROM sendvici";
                if ($result = mysqli_query($connection,$query)) {

                    /* fetch object array */
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<tr>';
                        echo '<td class="col-xs-12 naziv">'.$row['naziv'].'</td>';
                        echo '<td class="col-xs-12">'.$row['cena'].'</td>';
                        echo '<td class="col-xs-12"><button type="button" class="btn btn-success item-button"> <span class="glyphicon glyphicon-ok"></span> dodaj</button></td>';
                        echo '</tr>';
                    }
                }
            ?>
            </table>
        </div>
        <br>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="sec" id="pice">
      <div class="container container-fluid">
        <h1 class="col-md-3 col-xs-12 text-center">Pice                    </h1>
        <p class="col-md-9 col-xs-12">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
          sed do eiusmod tempor incididunt ut labore et dolore magna 
          aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
          ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis 
          aute irure dolor in reprehenderit in voluptate velit esse cillum 
          dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
          non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
        </p><br>
        <h2>lista</h2>
        <div class="col-md-offset-3 col-md-6 col-xs-12">
            <table class="table table-hover">
                <?php
                $query = "SELECT * FROM pice";
                if ($result = mysqli_query($connection,$query)) {

                    /* fetch object array */
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<tr>';
                        echo '<td class="col-xs-12">'.$row['naziv'].'</td>';
                        echo '<td class="col-xs-12">'.$row['cena'].'</td>';
                        echo '<td class="col-xs-12"><button type="button" class="btn btn-success item-button"> <span class="glyphicon glyphicon-ok"></span> dodaj</button></td>';
                        echo '</tr>';
                    }
                }
            ?>
            </table>
        </div>
        <br>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="sec" id="rostilj">
      <div class="container container-fluid">
        <h1 class="col-md-3 col-xs-12 text-center">Rostilj</h1>
        <p class="col-md-9 col-xs-12">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
          sed do eiusmod tempor incididunt ut labore et dolore magna 
          aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
          ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis 
          aute irure dolor in reprehenderit in voluptate velit esse cillum 
          dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
          non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
        </p><br>
        <h2>lista</h2>
        <div class="col-md-offset-3 col-md-6 col-xs-12">
          <table class="table table-hover">
                <?php
                $query = "SELECT * FROM rostilj";
                if ($result = mysqli_query($connection,$query)) {

                    /* fetch object array */
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<tr>';
                        echo '<td class="col-md-6">'.$row['naziv'].'</td>';
                        echo '<td class="col-md-2">'.$row['cena'].'</td>';
                        echo '<td class="col-md-2"><button type="button" class="btn btn-success item-button"> <span class="glyphicon glyphicon-ok"></span> dodaj</button></td>';
                        echo '</tr>';
                    }
                }
            ?>
            </table>
        </div>
        <br>
      </div>
    </div>
  </div>
<?php 
include('includes/footer.php');
mysqli_close($connection);
?>