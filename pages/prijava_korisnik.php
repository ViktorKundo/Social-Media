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
        ?>
    
    <section class="gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <div class="mb-md-5 mt-md-4 pb-5">

                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                    <p class="text-white-50 mb-5">Unesi email ili korisnicko ime i lozinku</p>

                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="form-outline form-white mb-4">
                            <input type="text" id="emailIme-admin" name="emailIme" class="form-control form-control-lg" />
                            <label class="form-label" for="emailIme-admin">korisnicko ime ili email</label>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <input type="password" id="lozinka-admin" name="sifra" class="form-control form-control-lg" />
                            <label class="form-label" for="lozinka-admin">Password</label>
                        </div>


                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Uloguj se</button>


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