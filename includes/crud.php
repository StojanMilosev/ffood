<?php
/**
 * Crud class
 * universal implementation
 */
class Crud{

    //add vriables

    public function create($connection,$fields,$table,$data){
        $query = "INSERT INTO $table($fields) VALUES($data)";
        $result = mysqli_query($connection,$query);
        //provera uspesnosti query-a
        if($result){
            return  mysqli_error($connection);
        }else {
            return true;
        }
    }
    public function read($connection,$fields,$table,$condition){
        $query = "SELECT $fields FROM $table WHERE $condition";
        $result = mysqli_query($connection,$query);
        if(!$result){
            return mysqli_error($connection);
        }else{
            $jason_data = mysqli_fetch_assoc($result);

            return $jason_data;
        }

    }
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