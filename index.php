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
    if(!isset($_SESSION['email'])){
         
        echo '<a href="registracija.php">Registracija</a><br>';
        echo '<a href="prijava.php">Prijava</a><br>';
        echo '<a href="prijava_admin.php">Prijava kao admin</a>';
    }
    else{
        $email = $_SESSION["email"];
        
        echo '
        <p>
            Dobro dosao '.$email.'
        </p>

        <h4><a href = "tema.php">Kreiraj temu</a></h4>

        <a href="logout.php"><button>
            Logout
        </button></a>
        
        ';
        
    }
    
    ?>
    <div> 
    <?php 
            include "konekcija.php";
            $sql = "SELECT id,naslov,opis FROM teme";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                echo "
                    <a href = 'tema_prikaz.php?id=".$id.".php'><h3>
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