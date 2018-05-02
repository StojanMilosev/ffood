<?php
/**
 * Crud class
 * universal implementation
 */
class Crud{

    //add vriables
//dodaanje novog podataka
    public function create($connection,$fields,$table,$data){
//kreiranje SQL komande sa podatcima koji su prosledjeni
        $query = "INSERT INTO $table($fields) VALUES($data)";
//vracanje reuzltata upita
        $result = mysqli_query($connection,$query);
//provera uspesnosti query-a
        if($result){
            return  mysqli_error($connection);
        }else {
            return true;
        }
    }
//iscitavanje podataka
    public function read($connection,$fields,$table,$condition){
//kreiranje SQL upita 
        $query = "SELECT $fields FROM $table WHERE $condition";
//provera uspesnosti query-a
        $result = mysqli_query($connection,$query);
        if(!$result){
            return mysqli_error($connection);
        }else{
//ako je poziv uspeo podatke stavi u associative array
            $jason_data = mysqli_fetch_assoc($result);
//vrati podatke
            return $jason_data;
        }

    }
/*
*iscitavanje pojedinacnih podatak koje nije zazrsena
*/ 
 public function get($connection,$fields,$table){
        $query = "SELECT $fields FROM $table";
        $result = mysqli_query($connection,$query);
        if(!$result){
            return mysqli_error($connection);
        }else{
            $jason_data = array();
            while($r = mysqli_fetch_assoc($result)){
                $jason_data[] = $r;
            }
            return $jason_data;
        }

    }
/*
*update podataka koji nije zavrsen do kraja
*/ 	
    public function update($connection,$fields,$table,$condition){
        $query = "UPDATE $table SET $fields WHERE $condition";
        //end of query pacijent
        $result = mysqli_query($connection, $query);
        //provera upita
        if(!$result){
            return mysqli_error($connection);
        }else {
            return true;
        }
    }
	
/*
* Brisanje podataka
*/
    public function delete($connection,$fields,$table,$condition){
        $query = "DELETE FROM $table WHERE $condition";
        $result = mysqli_query($connection,$query);
        if(!$result){
            return mysqli_error($connection);
        }else {
            return true;
        }
    }
}