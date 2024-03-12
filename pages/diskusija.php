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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	    <link rel="stylesheet" href="../css/style.css" type="text/css">
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

            $sql = "SELECT * FROM komentari WHERE id_diskusije = $idDiskusije AND roditeljski_komentar_id IS NULL";
            $results = $conn->query($sql);

            if ($results->num_rows > 0)
            while($row = $results->fetch_assoc()) {
                $id = $row["id"];
                echo "
                <div >   
                    <h3>
                    ".$row["tekst"]."
                    </h3>
                    <p>
                    ".$row["korisnicko_ime"]."
                    </p>
                    <p>
                    ".$row["kreiran"]."
                    </p>
                    <p onclick = 'odgovori(event)'>
                        Odgovori
                    </p>
                    <form class='formaOdgovori' action = '../utils/dodaj_odgovor.php' method = 'POST' >
                        <textarea name = 'tekst'></textarea><br>
                        <input type = 'hidden' value = '$id' name ='id_roditeljskog_komentara'></input>
                        <input type = 'submit' value = 'Odgovori' ></input>
                    </form>
                    ";
                    $sql2 = "SELECT * FROM komentari WHERE id_diskusije = $idDiskusije AND roditeljski_komentar_id = $id";
                    $results2 = $conn->query($sql2);
        
                    if ($results2->num_rows > 0)
                    while($row = $results2->fetch_assoc()) {
                        echo "
                        <div class='odgovor'>
                            <h3>
                            ".$row["tekst"]."
                            </h3>
                            <p>
                            ".$row["korisnicko_ime"]."
                            </p>
                        </div>";
                    }
            echo "</div>
                <hr>
                ";
            }
            ?>
            
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script src="../scripts/komentar.js">
        
        </script>
    </body>
</html>