<?php
/**
 * Created by .
 * User: Stojan Milosev
 * Date: 18/01/17
 * Time: 4:54 PM
 */
require ('data.php');
require ('crud.php');

//instanciranje konekije za bazom podataka
$instance = ConnectDb::getInstance();
$connection = $instance->getConnection();
//instanciranje logger-a
$logger = Logger::getInstance();
//pokusaj modulacije
$crud = new Crud;

//-------------------
if(isset($_POST)){
    $table = $_POST["table"];
    $date = date("Y-m-d h:i:s");
    if($_POST["action"]==="insert"){
        if($table==="pregled"){
            $vrsta_pregleda = $_POST["pregled"];
            $ime = $_POST["ime"];
            $prezime = $_POST["prezime"];
            $jmbg = $_POST["jmbg"];
            $brKartona = $_POST["brKartona"];

            $success = "Uspesno dodat ".$table;
            $fields = "ime,
                        prezime,
                        jmbg,
                        broj_zdravstvenog_kartona,
                        vrsta_pregleda,
                        datum";
            $data = "'$ime',
                            '$prezime',
                            '$jmbg',
                            '$brKartona',
                            '$vrsta_pregleda',
                            '$date'";
            $rez = $crud->create($connection,$fields,$table,$data,$success);

            $jason = json_encode($rez);
            echo $jason;
            //db query
            $query = "INSERT INTO pregled(
                            ime,
                            prezime,
                            jmbg,
                            broj_zdravstvenog_kartona,
                            vrsta_pregleda,
                            datum
                        )
                        VALUES(
                            '$ime',
                            '$prezime',
                            '$jmbg',
                            '$brKartona',
                            '$vrsta_pregleda',
                            '$date'
                        )";
            //end of query
            $result = mysqli_query($connection,$query);
            //provera uspesnosti query-a
            if(!$result){
                echo '<br><p class="br-danger">Error description:'. mysqli_error($connection).'</p>';
            }else {

                echo '<br><p class="alert alert-success">Uspesno zakazivanje pregleda</p>';
            }
            //end if pregled*/
        }elseif($table==="pacijent"){
            $ime = $_POST["ime"];
            $prezime = $_POST["prezime"];
            $jmbg = $_POST["jmbg"];
            $brKartona = $_POST["brKartona"];
            //query
            $query = "INSERT INTO pacijent(
                            ime,
                            prezime,
                            jmbg,
                            broj_zdravstvenog_kartona
                        )
                        VALUES(
                            '$ime',
                            '$prezime',
                            '$jmbg',
                            '$brKartona'
                        )";
            //end of query
            $result = mysqli_query($connection,$query);
            if(!$result){
                echo '<br><p class="br-danger">Error description:'. mysqli_error($connection).'</p>';
            }else{
                echo '<br><p class="alert alert-success">Uspesno dodavanje pacijenta</p>';
                //logging
                $message = "unos podataka ".$table."-a";
                $logger->log($connection,$message,$date);
            }
            //end elseif pacijent
        }
    }elseif($_POST["action"]==="update"){
        $id = $_POST["id"];
        //provera tabele zapromenu podataka
        if($table==="pregled"){
            $vrsta_pregleda = $_POST["pregled"];
            $ime = $_POST["ime"];
            $prezime = $_POST["prezime"];
            $jmbg = $_POST["jmbg"];
            $brKartona = $_POST["brKartona"];

            //db query pregled
            $query = "UPDATE $table SET
                                ime='$ime',
                                prezime='$prezime',
                                jmbg='$jmbg',
                                broj_zdravstvenog_kartona = '$brKartona',
                                vrsta_pregleda='$vrsta_pregleda',
                                datum = '$date'
                              WHERE id='$id'";
            //end of query pregled
            $result = mysqli_query($connection, $query);
            //provera uspesnosti query-a
            if(!$result){
                echo '<br><p class="br-danger">Error description:'. mysqli_error($connection).'</p>';
            }else {

                echo '<br><p class="alert alert-success">Uspesna promena podataka pregleda</p>';
            }
            //end if pregled
        }elseif($table==="pacijent"){
            $ime = $_POST["ime"];
            $prezime = $_POST["prezime"];
            $jmbg = $_POST["jmbg"];
            $brKartona = $_POST["brKartona"];
            //db query pacijent
            $query = "UPDATE $table SET
                                ime='$ime',
                                prezime='$prezime',
                                jmbg='$jmbg',
                                broj_zdravstvenog_kartona = '$brKartona'
                              WHERE id='$id'";
            //end of query pacijent
            $result = mysqli_query($connection, $query);
            //provera upita
            if(!$result){
                echo '<br><p class="br-danger">Error description:'. mysqli_error($connection).'</p>';
            }else{
                echo '<br><p class="alert alert-success">Uspesna promena podataka pacijenta</p>';
            }
            //end elseif pacijent
        }
        //end if update
    }elseif($_POST["action"]==="delete"){
        $id = $_POST['id'];
        $fields = "*";
        $id = $_POST["id"];
        $condition = "id='".$id."'";
        $success = "uspesno obrisan ".$table;
        $rezultat = $crud->delete($connection,$fields,$table,$condition,$success);
       //end elseif delete*/
        if(!$rezultat){
            echo '<br><p class="br-danger">Error description:'. $rez.'</p>';
        }else {

           echo '<br><p class="alert alert-success">Usesno obrisan '.$table.'</p>';

            //logging
            $message = "brisanje podataka ".$table."-a";
            $logger->log($connection,$message,$date);
        }
    }elseif($_POST["action"]==="get"){
        $fields = "*";
        $rez = $crud->get($connection,$fields,$table);
        $jason = json_encode($rez);
        echo $jason;
        //end elseif get
    }elseif($_POST["action"]==="modal"){
        $fields = "*";
        $id = $_POST["id"];
        $condition = "id='".$id."'";
        $rezultat = $crud->read($connection,$fields,$table,$condition);
        $jason = json_encode($rezultat);
        echo $jason;
        //end elseif modal
    }
    //end if isset $_POST*/
};