<?php
class Database
{

    private $host = "localhost";
    private $db_name = "filmografija";
    private $username = "root";
    private $password = "";
    public $conn;
   
    // konektovanje sa bazom
    public function getConnection(){
   
        $this->conn = null;
   
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Neuspesna konekcija: " . $exception->getMessage();
        }
   
        return $this->conn;
    }


}
?>