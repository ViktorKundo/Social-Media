
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <?php if(isset($_SESSION["Uspešan_unos"])) {?>
    <h3>
        <?php 
            echo $_SESSION["Uspešan_unos"];
            unset($_SESSION["Uspešan_unos"]);
        }
            else if(isset($_SESSION["errorUnosTeme"])){
                echo $_SESSION["errorUnosTeme"];
                unset($_SESSION["errorUnosTeme"]);
            }
        ?>
    </h3>
    
    <form action="dodaj_temu.php" method="POST" enctype="multipart/form-data">
        <label>Naslov: </label>
        <input type = "text" name = "naslov" ><br>
        <label>Opis: </label>
        <textarea name = "opis" ></textarea><br>

        <input type = "submit" value = "Kreiraj"></textarea>
    </form>
    <p>
        <a href="../utils/logout.php">Izloguj se</a>
    </p>
</body>
</html>