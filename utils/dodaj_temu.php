<?php

session_start();

if(!isset($_SESSION["adminIme"])){
    header("Location: index.php");
    exit();
}

$adminIme = $_SESSION["adminIme"];
   

if($_SERVER["REQUEST_METHOD"] == "POST") {

        require_once "../database/konekcija.php";

        $naslov = test_input($_POST["naslov"]);
        $opis = test_input($_POST["opis"]);
        if($naslov == null){
            $_SESSION["errorUnosTeme"] = "Morate uneti naslov";
            $conn->close();
            header("location: admin_dashboard.php");
            exit();
        }
        if($opis == null){
            $_SESSION["errorUnosTeme"] = "Morate uneti opis";
            $conn->close();
            header("location: ../pages/admin_dashboard.php");
            exit();
        }
        if(isset($_FILES["putanjaSlike"]) && $_FILES["putanjaSlike"]["error"] == 0){
            $filename = $_FILES["putanjaSlike"]["name"];

            if(file_exists("../images/" . $filename)){
                echo $filename . " vec postoji";
            } else{
                if(move_uploaded_file($_FILES["putanjaSlike"]["tmp_name"], "../images/" . $filename)){
                    $filename = "/images/" . $filename;

                    $sql = "INSERT INTO teme (naslov, opis, putanjaSlike, ime_admina) VALUES (?,?,?,?)";
                    
                    $run = $conn->prepare($sql);
                    $run -> bind_param("ssss",$naslov,$opis,$filename,$adminIme);
                    $run->execute();
                    
                    $_SESSION["Uspešan_unos"] = "Uspešno ste dodali novu temu";
            
                    header("location: ../pages/admin_dashboard.php");
                }
            }
        }
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>