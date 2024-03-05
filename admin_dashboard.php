
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <?php if(isset($_SESSION["Uspšan_unos"])) :?>
    <h3>
        <?php 
            echo $_SESSION["Uspšan_unos"];
            unset($_SESSION["Uspšan_unos"]);
        ?>
    </h3>
    <?php endif;?>
    <form action="dodaj_temu.php" method="POST" enctype="multipart/form-data">
        <label>Naslov: </label>
        <input type = "text" name = "naslov" ><br>
        <label>Opis: </label>
        <textarea name = "opis" ></textarea><br>

        <input type = "submit" value = "Kreiraj"></textarea>
    </form>
</body>
</html>