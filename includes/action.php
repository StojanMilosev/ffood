<?php

$cfg = include('config.php');
require ('crud.php');
//instanciranje konekije za bazom podataka
$connection = mysqli_connect($cfg->db_host,$cfg->db_username,$cfg->db_password,$cfg->db_name);
//pokusaj modulacije
$crud = new Crud;
if(array_key_exists('table', $_POST)){
    $table = $_POST['table'];    
    $date = date("Y-m-d h:i:s");
    if($_POST['action']==='create'){
        $naziv = $_POST['naziv'];
        $cena = $_POST['cena'];

        $fields = "naziv,cena";
        $data ="'$naziv','$cena'";

        $result = $crud->create($connection, $fields, $table, $data);
        if(!$result){
            echo $result;
        }else {
           echo "<p class='alert alert-success'>uspesno dodat prozivod</p>";
        }
    }else if($_POST['action']==='read'){
        $fields = "*";
        $rez = $crud->get($connection,$fields,$table);
        $jason = json_encode($rez);
        echo $jason;
    }elseif($_POST["action"]==="delete"){
        $id = $_POST['id'];
        $fields = "*";
        $condition = "id='".$id."'";
        $result = $crud->delete($connection,$fields,$table,$condition);
       //end elseif delete*/
        if(!$result){
            echo $result;
        }else {
           echo "<p class='alert alert-success'>uspesno brisan prozivod</p>";
        }
    }elseif($_POST["action"]==="get"){
        
    }
}