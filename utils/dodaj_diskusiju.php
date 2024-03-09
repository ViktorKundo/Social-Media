<?php

session_start();

if(!isset($_SESSION["email"])){
    header("Location: index.php");
    exit();
}

$idTeme = $_SESSION["id_teme"];
$email = $_SESSION["email"];
$korisnickoIme = $_SESSION["korisnicko_ime"];
   

if($_SERVER["REQUEST_METHOD"] == "POST") {

        require_once "../database/konekcija.php";

        $naslov = test_input($_POST["naslov_diskusije"]);
        $text = test_input($_POST["text_diskusije"]);
        if($naslov == null){
            $_SESSION["errorUnosDiskusije"] = "Morate uneti naslov";
            $conn->close();
            header("location: ../pages/tema.php?id=$idTeme.php");
            exit();
        }
        if($text == null){
            $_SESSION["errorUnosDiskusije"] = "Morate uneti text";
            $conn->close();
            header("location: ../pages/tema.php?id=$idTeme.php");
            exit();
        }

        $sql = "INSERT INTO diskusije(naslov, text, id_teme, korisnicko_ime) VALUES (?,?,?,?)";
        
        $run = $conn->prepare($sql);
        $run -> bind_param("ssis",$naslov,$text,$idTeme,$korisnickoIme);
        $run->execute();
        
        $_SESSION["Uspešan_unos"] = "Uspešno ste dodali novu diskusiju";

        header("location: ../pages/tema.php?id=$idTeme.php");
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>