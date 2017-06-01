<?php
class ConnectDb {
  private static $instance = null;
  private $conn;
   
  //konekcija ka bazi se vrsi konstruktorom
  private function __construct()
  {
    $this->conn = mysqli_connect($cfg->db_host,$cfg->db_username,$cfg->db_password,$cfg->db_name);
    if(mysqli_connect_errno()){
       echo mysqli_connect_error();
    }
  }
  
  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new ConnectDb();
    }
   
    return self::$instance;
  }
  
  public function getConnection()
  {
    return $this->conn;
  }
}

/**
 * Logger class
 * Singleton using lazy implementation
 */
class Logger
{
    private static $instance = NULL;
    private $logs;

    private function __construct() {
        $this->logs = array();
    }

    public function getInstance() {
        // Instantiate itself if not instantiated
        if(self::$instance === NULL) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }

    public function log($connection,$message,$date) {
        if(!empty($message)) {
            $fields = "entry,datum";
            $data = "'Upesno".$message."','.$date.'";
            $query = "INSERT INTO log($fields) VALUES($data)";
            $result = mysqli_query($connection,$query);
            //provera uspesnosti query-a
            if(!$result){
                return  mysqli_error($connection);
            }else {
                return true;
            }
        }else{
            echo "error";
        }
    }

    public function get_logs($connection) {
        $query = "SELECT * FROM log";
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
};

?>