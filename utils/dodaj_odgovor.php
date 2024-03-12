<?php

session_start();

if(!isset($_SESSION["email"])){
    header("Location: index.php");
    exit();
}

$idDiskusije = $_SESSION["id_diskusije"];
$korisnickoIme = $_SESSION["korisnicko_ime"];
   

if($_SERVER["REQUEST_METHOD"] == "POST") {

        require_once "../database/konekcija.php";

        $idRoditeljskogKomentara = test_input($_POST["id_roditeljskog_komentara"]);
        $tekst = test_input($_POST["tekst"]);
        if($tekst == null){
            $_SESSION["error_unos_odg"] = "Morate uneti neki tekst";
            $conn->close();
            header("location: ../pages/tema.php?id=$idDiskusije.php");
            exit();
        }
        $sql = "INSERT INTO komentari(tekst, roditeljski_komentar_id, korisnicko_ime, id_diskusije) VALUES (?,?,?,?)";
        
        $run = $conn->prepare($sql);
        $run -> bind_param("sisi", $tekst, $idRoditeljskogKomentara, $korisnickoIme, $idDiskusije);
        $run -> execute();
        
        $_SESSION["Uspešan_unos"] = "Uspešno ste dodali novi komentar";

        header("location: ../pages/diskusija.php?id=$idDiskusije");
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>