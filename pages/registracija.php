<?php
    session_start();
        //          REGISTRACIJA KORISNIKA
        $emailInput = $usernameInput = $nameInput = $emailRepeatInput = $sifraInput = "";
        $tacno = false;
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $tacno = true;
            $imeZaPrikaz = test_input($_POST["imePrikaz"]);
            $korisnickoIme = test_input($_POST["korisnickoIme"]);
            $sifra = test_input($_POST["sifra"]);
            $email = test_input($_POST["email"]);
            $emailRepeat = test_input($_POST["emailR"]);
            if(empty($_POST["imePrikaz"])){
                $nameInput = "Morate uneti ime za prikaz";
                $tacno = false;
            }
            if(empty($_POST["korisnickoIme"])){
                $usernameInput = "Morate uneti korisnicko ime";
                $tacno = false;
            } else{
                require_once "../database/konekcija.php";
                $sql = "SELECT korisnicko_ime FROM korisnici";
                $results = $conn->query($sql);
                if($results->num_rows > 0){
                    while($row = $results->fetch_assoc()){
                        if($row["korisnicko_ime"] == $korisnickoIme){
                            $usernameInput = "Morate uneti drugo korisnicko ime";
                            $tacno = false;
                        }
                    }
                }
            }
            if(empty($_POST["email"])){
                $_SESSION["greskaRegistracije"] = "Morate uneti email";
                $tacno = false;
            }
            else {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $_SESSION["greskaRegistracije"] = "email mora biti ispravan";
                    $tacno = false;
                }
            }
            if(empty($_POST["sifra"]))
            {
                $_SESSION["greskaRegistracije"] = "Morate uneti sifru";
                $tacno = false;
            }
            else {
                if(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])(?=.*[A-Z])(?=.*[a-z])(?=.*[ !#$%&'\(\) * +,-.\/[\\] ^ _`{|}~\"])[0-9A-Za-z !#$%&'\(\) * +,-.\/[\\] ^ _`{|}~\"]{8,50}$/",$sifra)){
                    $_SESSION["greskaRegistracije"] = "Sifra mora sadrzati 1 specijalan karakter, 1 malo slovo, 1 veliko slovo, 1 broj i najmanje 8 karaktera";
                    $tacno = false;

                }
            }
            if(empty($_POST["emailR"])){
                $_SESSION["greskaRegistracije"] = "Morate ponovo uneti email";
                $tacno = false;
            }  
            else {
                if($email != $emailRepeat){
                    $_SESSION["greskaRegistracije"] = "Morate uneti email koji se poklapa sa prethodnim";
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

        if($tacno){

            //UNOS PODATAKA U BAZU

            include "database/konekcija.php";
            $hashSifra = password_hash($sifra, PASSWORD_DEFAULT);
            $sql = "INSERT INTO korisnici (korisnicko_ime, ime_za_prikaz, email, lozinka)
            VALUES (?, ?, ?, ?);";
            $run = $conn->prepare($sql);
            $run -> bind_param("ssss",$korisnickoIme,$imeZaPrikaz,$email,$hashSifra);

            $run->execute();
            $_SESSION['email'] = $email;
            $_SESSION["ime_prikaz"] = $imeZaPrikaz;
            $_SESSION["uspešna_registracija"] = "Uspešno ste se registrovali!";
            header("Location: ../index.php");
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body>
        <?php
            require_once "../components/navbar.php";
        ?>
    <section class="gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <div class="mb-md-5 mt-md-4 pb-5">

                    <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                    <p class="text-white-50 mb-5">Unesi podatke potrebne za registraciju</p>

                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="form-outline form-white mb-4">
                            <input type="text" id="korisnicko-ime" name="korisnickoIme" class="form-control form-control-lg" />
                            <label class="form-label" for="korisnicko-ime">Korisnicko ime ili email</label>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <input type="text" id="ime-prikaz" name="imePrikaz" class="form-control form-control-lg" />
                            <label class="form-label" for="ime-prikaz">Ime za prikaz</label>
                        </div>
                        
                        <div class="form-outline form-white mb-4">
                            <input type="text" id="email" name="email" class="form-control form-control-lg" />
                            <label class="form-label" for="email">Email</label>
                        </div>
                        
                        <div class="form-outline form-white mb-4">
                            <input type="text" id="emailR" name="emailR" class="form-control form-control-lg" />
                            <label class="form-label" for="emailR">Ponovite email</label>
                        </div>
                        

                        <div class="form-outline form-white mb-4">
                            <input type="password" id="lozinka" name="sifra" class="form-control form-control-lg" />
                            <label class="form-label" for="lozinka">Password</label>
                        </div>


                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Registruj se</button>


                        </div>
                    </form>

                    <?php
                        if(isset($_SESSION["errorPrijavaKorisnika"])){
                            echo "<h4 class='fw-bold mb-2 text-uppercase'>".$_SESSION["errorPrijavaKorisnika"] . "</h4>";
                            unset($_SESSION["errorPrijavaKorisnika"]);
                        }
                    ?>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>