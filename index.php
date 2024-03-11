<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pocetna</title>
</head>
<body>
    <?php
    if(!isset($_SESSION['email']) && !isset($_SESSION['adminIme'])){
         
        echo '<a href="pages/registracija.php">Registracija</a><br>';
        echo '<a href="pages/prijava_korisnik.php">Prijava</a><br>';
        echo '<a href="pages/prijava_admin.php">Prijava kao admin</a>';
    }
    else{
        $email = $_SESSION["email"];
        $prikazIme = $_SESSION["ime_prikaz"];
        
        echo '
        <p>
            Dobro dosao '.$prikazIme.'
        </p>


        <a href="utils/logout.php"><button>
            Logout
        </button></a>
        
        ';
        
    }
    
    ?>
    <div> 
    <?php 
            include "database/konekcija.php";
            $sql = "SELECT id_teme,naslov,opis FROM teme";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $idTeme = $row["id_teme"];
                $_SESSION["id_teme"] = $idTeme;
                echo "
                    <a href = 'pages/tema.php?id=$idTeme'><h3>
                    ".$row["naslov"]."
                    </h3></a>
                    <p>
                    ".$row["opis"]."
                    </p><hr><br>
                ";
            }
            } else {
            echo "<h4>Nema tema</h4>";
            }
            $conn->close();
    ?>
    </div>
</body>
</html>