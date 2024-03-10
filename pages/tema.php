<?php
session_start();

//Proverava da li je izabrana tema
if(isset($_GET["id_teme"])){
    $idTeme = $_GET["id_teme"];
    $_SESSION["id_teme"] = $idTeme;
}
else
$idTeme = $_SESSION["id_teme"];

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
</head>
<body>
    <?php
        require_once "../components/tema_prikaz.php";

        if($email_set == "ulogovan"){
            if(isset($_SESSION["errorUnosDiskusije"])){
                echo"$_SESSION[errorUnosDiskusije]";
                unset($_SESSION["errorUnosDiskusije"]);
            }
            echo "<p>Dodaj diskusiju</p>";
            echo '
                    <form action="../utils/dodaj_diskusiju.php" method="post">
                        <label>Naslov: </label>
                        <input type = "text" name = "naslov_diskusije" ></input><br>
                        <label>Text: </label>
                        <input type = "text" name = "text_diskusije"></input><br>
                        <input type = "submit" value = "Dodaj diskusiju"></input>
                    </form>
                ';
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>          
    <p>
        <a href="../index.php">Nazad</a>
    </p>
</body>
</html>