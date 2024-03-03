<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
</head>
<body>
<?php
        $emailInput = $emailRepeatInput = $sifraInput = "";
        $tacno = false;
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $tacno = true;
            $imeZaPrikaz = test_input($_POST["prikazIme"]);
            $korisnickoIme = test_input($_POST["korisnickoIme"]);
            $email = test_input($_POST["email"]);
            $sifra = test_input($_POST["sifra"]);
            $emailRepeat = test_input($_POST["emailR"]);
            if(empty($_POST["email"])){
                $emailInput = "Morate uneti email";
                $tacno = false;
            }
            else {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $emailInput = "email mora biti ispravan";
                    $tacno = false;
                }
            }
            if(empty($_POST["sifra"]))
            {
                $sifraInput = "Morate uneti sifru";
                $tacno = false;
            }
            else {
                if(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])(?=.*[A-Z])(?=.*[a-z])(?=.*[ !#$%&'\(\) * +,-.\/[\\] ^ _`{|}~\"])[0-9A-Za-z !#$%&'\(\) * +,-.\/[\\] ^ _`{|}~\"]{8,50}$/",$sifra)){
                    $sifraInput = "Sifra mora sadrzati 1 specijalan karakter, 1 malo slovo, 1 veliko slovo, 1 broj i najmanje 8 karaktera";
                    $tacno = false;

                }
            }
            if(empty($_POST["emailR"])){
                $emailRepeatInput = "Morate ponovo uneti email";
                $tacno = false;
            }  
            else {
                if($email != $emailRepeat){
                    $emailRepeatInput = "Morate uneti email koji se poklapa sa prethodnim";
                    $tacno = false;
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
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label>Korisnicko ime: </label>
        <input type = "text" name = "korisnickoIme" value = ""><span class = "error"><?php echo $usernameInput; ?></span><br>
        <label>Ime za prikaz: </label>
        <input type = "text" name = "imePrikaz" value = ""><span class = "error"><?php echo $nameInput; ?></span><br>
        <label>Email: </label>
        <input type = "text" name = "email" value = ""><span class = "error"><?php echo $emailInput; ?></span><br>
        <label>Ponovljen Email: </label>
        <input type = "text" name = "emailR" value = ""><span class = "error"><?php echo $emailRepeatInput; ?></span><br>
        <label>Sifra: </label>
        <input type = "text" name = "sifra" value = ""><span class = "error"><?php echo $sifraInput; ?></span><br>
        <input type = "submit" value = "Registruj se"></input>
    </form>
    <?php
        if($tacno){
            include "konekcija.php";
            $hashSifra = password_hash($sifra, PASSWORD_DEFAULT);
            $sql = "INSERT INTO korisnici (email, sifra)
            VALUES ('$email', '$hashSifra');";
            if($conn->query($sql) === TRUE){
                echo "Uspesno insertovane vrednosti";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            header("Location: index.php");
        }
    ?>
</body>
</html>