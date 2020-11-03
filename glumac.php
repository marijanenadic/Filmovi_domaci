<?php
class Glumac{
  
    // veza sa bazom i naziv tabele
    private $conn;
    private $table_name = "glumci";
  
    public $id;
    public $glumac;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // drop-down lista
    function read(){
        // SELECT * FROM glumci ORDER BY name
        $query = "SELECT
                    id, glumac
                FROM
                    " . $this->table_name . "
                ORDER BY
                    id";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    // cita ime glumca po njegovom id-ju
    function readName(){
      
        $query = "SELECT glumac FROM " . $this->table_name . " WHERE id = ? limit 0,1";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
  
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        $this->glumac = $row['glumac'];
}
  
}
?>