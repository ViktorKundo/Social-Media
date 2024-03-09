<?php
    session_start();
    if(isset($_SESSION["email"])){
        header("Location: index.php");
    }
    
    $emailInput = $sifraInput = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        //           PRIJAVA KORISNIKA

        require_once "../database/konekcija.php";
        
        $emailIme = test_input($_POST["emailIme"]);
        $sifra = test_input($_POST["sifra"]);

        //       DEO KODA ZA PRIJAVU POMOĆU MEJLA ILI USERNAME-A
        $sql = "SELECT email, korisnicko_ime, lozinka, ime_za_prikaz FROM korisnici WHERE email = ? or korisnicko_ime = ?";
        
        $run = $conn->prepare($sql);
        $run -> bind_param("ss",$emailIme, $emailIme);
        $run->execute();
        
        $results = $run->get_result();
        

        if($results->num_rows == 1){

            $korisnik = $results -> fetch_assoc();

            if(password_verify($sifra,$korisnik["lozinka"])){
                $_SESSION["email"] = $korisnik["email"];
                $_SESSION["ime_prikaz"] = $korisnik["ime_za_prikaz"];
                $_SESSION["korisnicko_ime"] = $korisnik["korisnicko_ime"];
                $conn->close();
                header("Location: ../index.php");
            } else{
                $_SESSION["errorPrijavaKorisnika"] = "netacan password";
                $conn->close();
                header("location: prijava_korisnik.php");
                exit();
            }
        }
        else{
            $_SESSION["errorPrijavaKorisnika"] = "netacno korisnicko ime ili email";
            $conn->close();
            header("location: prijava_korisnik.php");
            exit();
        }
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>korisnik prijava</title>
</head>
<body>
    <?php
    //          GREŠKA U PRIJAVI

        if(isset($_SESSION["errorPrijavaKorisnika"])){
            echo $_SESSION["errorPrijavaKorisnika"] . "<br>";
            unset($_SESSION["errorPrijavaKorisnika"]);
        }
        ?>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label>Email ili Korisnicko ime: </label>
        <input type = "text" name = "emailIme" value = ""><br>
        <label>Sifra: </label>
        <input type = "text" name = "sifra" value = ""><br>
        <input type = "submit" value = "Prijavi se"></input>
    </form>
</body>
</html>