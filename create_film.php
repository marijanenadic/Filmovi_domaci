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
$page_title = "Unosenje filma";

// includujemo header
include_once "header_layout.php";
  
echo "<div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Procitaj filmove</a>
    </div>";
  
?>
<?php 

if($_POST){
  
    // postavljaju se properies filma
    $film->naziv = $_POST['naziv'];
    $film->opis = $_POST['opis'];
    $film->datum = $_POST['datum'];
    $film->glumac_id = $_POST['glumac_id'];
  
    // unesi film
    if($film->create()){
        echo "<div class='alert alert-success'>Product was created.</div>";
    }
  
    // ukoliko nastane greska, ispisuje se na konzoli
    else{
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
    }
}
?>
  
<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  
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
            // Cita filmove iz baze
            $stmt = $glumac->read();
  
            echo "<select class='form-control' name='glumac_id'>";
                echo "<option>Izabrati glumca koji glumi u filmu</option>";
  
                while ($row_gluma = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row_glumac);
                    echo "<option value='{$id}'>{$name}</option>";
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