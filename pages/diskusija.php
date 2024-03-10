<?php

    session_start();

    //Proverava da li je izabrana tema
    if(isset($_GET["id_diskusije"])){
        $idDiskusije = $_GET["id_diskusije"];
        $_SESSION["id_diskusije"] = $idDiskusije;
    }
    else
    $idDiskusije = $_SESSION["id_diskusije"];

    //Proverava da li je korisnik ulogovan
    if(isset($_SESSION["email"]))
    $email_set = "ulogovan";
    else
    $email_set = "";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tema</title>
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php

            if($email_set === "ulogovan")
            echo'<button onclick="prikazi()">Dodaj komentar</button>';
            echo'<div id = "dodajKomentar">
                    <form action="../utils/dodaj_komentar.php" method="post">
                        <label>Text: </label>
                        <input type = "text" name = "tekst"></input><br>
                        <input type = "submit" value = "Dodaj komentar"></input>
                    </form>
                </div>';

            require_once "../database/konekcija.php";

            $sql = "SELECT * FROM komentari WHERE id_diskusije = $id_diskusije";
            $results = $conn->query($sql);

            if ($results->num_rows > 0)
            while($row = $results->fetch_assoc()) {
                echo "
                    <h3>
                    ".$row["tekst"]."
                    </h3>
                    <p>
                    ".$row["korisnicko_ime"]."
                    </p>
                    <p>
                    ".$row["kreiran"]."
                    </p>
                ";
            }
        ?>
        <script src="../scripts/dodaj_komentar.js">
        
        </script>
    </body>
</html>