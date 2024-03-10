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

        $tekst = test_input($_POST["tekst"]);
        if($tekst == null){
            $_SESSION["errorUnosKom"] = "Morate uneti komentar";
            $conn->close();
            header("location: ../pages/tema.php?id=$idDiskusije.php");
            exit();
        }
        $sql = "INSERT INTO komentari(tekst, korisnicko_ime, id_diskusije) VALUES (?,?,?)";
        
        $run = $conn->prepare($sql);
        $run -> bind_param("sis",$tekst,$idDiskusije,$korisnickoIme);
        $run -> execute();
        
        $_SESSION["Uspešan_unos"] = "Uspešno ste dodali novi komentar";

        header("location: ../pages/diskusija.php?id=$idDiskusije.php");
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>