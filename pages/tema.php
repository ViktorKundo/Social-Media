<?php
session_start();

//Proverava da li je izabrana tema
if(isset($_GET["id_teme"])){
    $idTeme = $_GET["id_teme"];
    $_SESSION["id_teme"] = $idTeme;
}
else
$idTeme = $_SESSION["id_teme"];

//Proverava da li je korisnik ulogovan
if(isset($_SESSION["email"]))
$email_set = "ulogovan";
else
$email_set = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema</title>
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

        require_once "../components/tema_prikaz.php";

        if($email_set == "ulogovan"){
            if(isset($_SESSION["errorUnosDiskusije"])){
                echo"$_SESSION[errorUnosDiskusije]";
                unset($_SESSION["errorUnosDiskusije"]);
            }
            echo "
                <div class='container'>
                    <div class='row d-flex justify-content-center align-items-center'>
                        <p onclick='prikazi()'>Dodaj diskusiju</p>
                    </div>
                </div>
            ";
            echo '
                <div class="container" id="dodajDiskusiju">
                    <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark " style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">Diskusija</h2>
                            <p class=" mb-5">Unesi naslov, text i sliku diskusije</p>
        
                            <form action="../utils/dodaj_diskusiju.php" method="post" enctype="multipart/form-data">
                                <div class="form-outline form-white mb-4">
                                    <input type="text" id="naslov-diskusije" name="naslov_diskusije" class="form-control form-control-lg" />
                                    <label class="form-label" for="naslov-diskusije">Naslov</label>
                                </div>
        
                                <div class="form-outline form-white mb-4">
                                    <input type="text" id="text-diskusije" name="text_diskusije" class="form-control form-control-lg" />
                                    <label class="form-label" for="text-diskusije">Text</label>
                                </div>
                                
                                <div class="form-outline form-white mb-4">
                                    <input type="file" id="putanja-slike" name="putanjaSlike" class="form-control form-control-lg" />
                                    <label class="form-label" for="putanja-slike"">Slika</label>
                                </div>
        
                                <button class="btn btn-outline-success btn-lg px-5" type="submit">Dodaj diskusiju</button>
        
        
                                </div>
                            </form>
                            <button class="btn btn-outline-success btn-md px-5" onclick="zatvori()">
                                Zatvori
                            </button>
                        </div>
                        </div>        
                    </div>
                    </div>
                </div>
            ';
        }
                
                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                ?>          
    <script src="../scripts/dodaj_diskusiju.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>