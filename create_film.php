<?php
include_once 'Database.php';
include_once 'film.php';
include_once 'glumac.php';

// konekcija sa bazon
$database = new Database();
$db = $database->getConnection();
  
// konekcija sa objektima
$film = new Film($db);
$glumac = new Glumac($db);

// ime stranice
$naslovna = "Unosenje novog filma";

// includujemo header
include_once "header_layout.php";
  
echo "<div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Pogledaj sve filmove</a>
    </div>";
  
?>
<?php 

// ukoliko je kliknuto na dugme 'Unesi'
if (isset($_POST["submit"])){
    //Prikupljanje podataka sa forme
    
    if(isset($_POST['naziv'])&&isset($_POST['opis'])
        &&isset($_POST['datum']) && isset($_POST['glumac_id'])){
            $film->naziv = $_POST['naziv'];
            $film->opis = $_POST['opis'];
            $film->datum = $_POST['datum'];
            $film->glumac_id = $_POST['glumac_id'];
    
    //Operacije nad bazom
    include "Database.php";
    $sql="INSERT INTO filmovi (naziv, opis, datum, glumac_id) VALUES ('".$naziv."', '".$opis."', '".$datum."', '".$glumac_id."')";
    if (mysql_query($sql))
    {
    echo "<p>Novost je uspešno ubačena</p>";
    } 
    else {
    echo "<p>Nastala je greška pri ubacivanju novosti</p>" . mysql_error();
    }
    } else {
    //Ako POST parametri nisu prosleđeni
    echo "Nisu prosleđeni parametri!";
    }
    mysql_close($db);
    }
    
/*if(isset($_POST['submit'])){
    
    if(isset($_POST['naziv'])&&isset($_POST['opis'])
        &&isset($_POST['datum']) && isset($_POST['glumac_id'])){
    // postavljaju se properies filma
        $film->naziv = $_POST['naziv'];
        $film->opis = $_POST['opis'];
        $film->datum = $_POST['datum'];
        $film->glumac_id = $_POST['glumac_id'];
    
        
    // unesi film
        if($film->create()){
            echo "<div class='alert alert-success'>Film uspesno unet.</div>";
        }
  
    // ukoliko nastane greska, ispisuje se na konzoli
        else{
            echo "<div class='alert alert-danger'>Film nije uspeo da se unese.</div>";
        }
    }
}*/
?>
  
<!-- HTML form for creating a product -->
<form action="" method="post">
  
    <table class='table table-hover table-responsive table-bordered'>
  
        <tr>
            <td>Naziv</td>
            <td><input type='text' name='naziv' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Opis</td>
            <td><textarea name='opis' class='form-control'></textarea></td>
        </tr>

        <tr>
            <td>Datum</td>
            <td><input type='date' name='datum' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Glumac</td>
            <td>
            <?php
            // Cita glumce iz baze
            $stmt = $glumac->read();
  
            echo "<select class='form-control' name='glumac_id'>";
                echo "<option>Izabrati glavnog glumca</option>";
  
                while ($row_glumac = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row_glumac);
                    echo "<option value='{$id}'>{$glumac}</option>";
                }
  
            echo "</select>";
            ?>  
            </td>
        </tr>
  
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Unesi</button>
            </td>
        </tr>
  
    </table>
</form>
<?php
  
// includujemo footer
include_once "footer_layout.php";
?>