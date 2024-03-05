VicoLol123
<?php
    session_start();
    if(isset($_SESSION["adminIme"])){
        header("Location: admin_dashboard.php");
    }
    
    $imeInput = $sifraInput = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "konekcija.php";
        
        $ime = test_input($_POST["ime"]);
        $sifra = test_input($_POST["sifra"]);
        
        $sql = "SELECT ime, lozinka FROM admini WHERE ime=?";
        
        $run = $conn->prepare($sql);
        $run -> bind_param("s",$ime);
        $run->execute();
        
        $results = $run->get_result();
        

        if($results->num_rows == 1){

            $admin = $results -> fetch_assoc();

            if(password_verify($sifra,$admin["lozinka"])){
                $_SESSION["adminIme"] = $admin["ime"];
                $conn->close();
                header("Location: admin_dashboard.php");
            } else{
                $_SESSION["errorPrijavaAdmina"] = "netacan password";
                $conn->close();
                header("location: prijava_admin.php");
                exit();
            }
        }
        else{
            $_SESSION["errorPrijavaAdmina"] = "netacano ime";
            $conn->close();
            header("location: prijava_admin.php");
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
    <title>Admin prijava</title>
</head>
<body>
    <?php
        if(isset($_SESSION["errorPrijavaAdmina"])){
            echo $_SESSION["errorPrijavaAdmina"] . "<br>";
            unset($_SESSION["errorPrijavaAdmina"]);
        }
        ?>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label>Ime: </label>
        <input type = "text" name = "ime" value = ""><br>
        <label>Sifra: </label>
        <input type = "text" name = "sifra" value = ""><br>
        <input type = "submit" value = "Prijavi se"></input>
    </form>
</body>
</html>