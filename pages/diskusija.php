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

            require_once "../components/diskusija_prikaz.php";

            if($email_set === "ulogovan")
            echo'<button onclick="prikazi()">Dodaj komentar</button>';
            echo'<div id = "dodajKomentar">
                    <form action="../utils/dodaj_komentar.php" method="post">
                        <label>Text: </label>
                        <textarea name = "tekst"></textarea><br>
                        <input type = "submit" value = "Dodaj komentar"></input>
                    </form>
                </div>';

            require_once "../database/konekcija.php";

            $sql = "SELECT * FROM komentari WHERE id_diskusije = $idDiskusije";
            $results = $conn->query($sql);

            if ($results->num_rows > 0)
            while($row = $results->fetch_assoc()) {
        // NAPRAVI SESIJU ZA KOMENTAR I TO ŠALJI NA FORMU ZA ODGOVORE
                echo "
                <div onclick = 'odgovori(event)'>   
                    <h3>
                    ".$row["tekst"]."
                    </h3>
                    <p>
                    ".$row["korisnicko_ime"]."
                    </p>
                    <p>
                    ".$row["kreiran"]."
                    </p>
                    <form class='formaOdgovori' action = '../utils/odgovori.php' method = 'POST' >
                        <textarea name = 'tekst'></textarea><br>
                        <input type = 'submit' value = 'Odgovori' ></input>
                    </form>
                </div>
                <hr>
                ";
            }
            ?>
        <script src="../scripts/komentar.js">
        
        </script>
    </body>
</html>