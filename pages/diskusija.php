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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital@0;1&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital@0;1&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	    <link rel="stylesheet" href="../css/style.css" type="text/css">
    </head>
    <body>
            
        <?php

            require_once "../components/navbar.php";

            require_once "../components/diskusija_prikaz.php";

            if($email_set === "ulogovan")
            echo'<h5 class="ms-5 mt-5" onclick="prikazi()">Nov komentar</h5>';
            echo'<div id = "dodajKomentar">
                    <form action="../utils/dodaj_komentar.php" method="post">
                        <textarea name = "tekst"></textarea><br>
                        <button class="btn btn-outline-success btn-lg px-5" type="submit">Dodaj komentar</button>
                    </form>
                </div>';

            require_once "../database/konekcija.php";

            $sql = "SELECT * FROM komentari WHERE id_diskusije = $idDiskusije AND roditeljski_komentar_id IS NULL";
            $results = $conn->query($sql);

            if ($results->num_rows > 0)
            while($row = $results->fetch_assoc()) {
                $id = $row["id"];
                echo "
                <div class='ms-5'>   
                    <h3>
                        ".$row["tekst"]."
                    </h3>
                    <p>
                        Kreator: ".$row["korisnicko_ime"]."
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
                            <h6>
                            ".$row["tekst"]."
                            </h6>
                            <p>
                                Kreator:".$row["korisnicko_ime"]."
                            </p>
                        </div>";
                    }
            echo "</div>
                <hr>
                ";
            }
            ?>
            </div>
    </div>
            </main>
            
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script src="../scripts/komentar.js">
        
        </script>
    </body>
</html>