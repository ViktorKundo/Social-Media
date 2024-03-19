<?php
    session_start();
    if(isset($_SESSION["adminIme"])){
        header("Location: admin_dashboard.php");
    }
    
    $imeInput = $sifraInput = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "../database/konekcija.php";
        
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
                    <p class="text-white-50 mb-5">Unesi ime i lozinku admina</p>

                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="form-outline form-white mb-4">
                            <input type="text" id="ime-admin" name="ime" class="form-control form-control-lg" />
                            <label class="form-label" for="ime-admin">Ime</label>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <input type="password" id="lozinka-admin" name="sifra" class="form-control form-control-lg" />
                            <label class="form-label" for="lozinka-admin">Password</label>
                        </div>


                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Uloguj se</button>


                        </div>
                    </form>

                    <?php
                        if(isset($_SESSION["errorPrijavaAdmina"])){
                            echo "<h4 class='fw-bold mb-2 text-uppercase'>".$_SESSION["errorPrijavaAdmina"] . "</h4>";
                            unset($_SESSION["errorPrijavaAdmina"]);
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