<?php
class Film{
  
    // konektovanje sa bazom i postavljanje imena tabele
    private $conn;
    private $table_name = "filmovi";
  
    // object properties
    public $id;
    public $naziv;
    public $opis;
    public $glumac_id;
    public $datum;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // pravljenje filma
    function create(){
  
        //upit
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    naziv=naziv, opis=opis, glumac_id=glumac_id, datum=datum";
  
        $stmt = $this->conn->prepare($query);
  
        // postovane vrednosti
        $this->naziv=htmlspecialchars(strip_tags($this->naziv));
        $this->opis=htmlspecialchars(strip_tags($this->opis));
        $this->datum=htmlspecialchars(strip_tags($this->datum));
        $this->glumac_id=htmlspecialchars(strip_tags($this->glumac_id));
  
        //time-stamp
        $this->timestamp = date('Y-m-d H:i:s');
  
        // dodaj vrednosti promenljivima
        $stmt->bindParam(":naziv", $this->naziv);
        $stmt->bindParam(":opis", $this->opis);
        $stmt->bindParam(":datum", $this->datum);
        $stmt->bindParam(":glumac_id", $this->glumac_id);
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
}
?>