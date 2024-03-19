
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    <?php if(isset($_SESSION["Uspešan_unos"])) {?>
    <h3>
        <?php 
            echo $_SESSION["Uspešan_unos"];
            unset($_SESSION["Uspešan_unos"]);
        }
            else if(isset($_SESSION["errorUnosTeme"])){
                echo $_SESSION["errorUnosTeme"];
                unset($_SESSION["errorUnosTeme"]);
            }
        ?>
    </h3>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark " style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
                <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Tema</h2>
                <p class=" mb-5">Unesi naslov, text i sliku teme</p>

                <form action="../utils/dodaj_temu.php" method="post" enctype="multipart/form-data">
                    <div class="form-outline form-white mb-4">
                        <input type="text" id="naslov-teme" name="naslov" class="form-control form-control-lg" />
                        <label class="form-label" for="naslov-teme">Naslov</label>
                    </div>

                    <div class="form-outline form-white mb-4">
                        <input type="text" id="text-teme" name="opis" class="form-control form-control-lg" />
                        <label class="form-label" for="text-teme">Text</label>
                    </div>
                    
                    <div class="form-outline form-white mb-4">
                        <input type="file" id="putanja-slike" name="putanjaSlike" class="form-control form-control-lg" />
                        <label class="form-label" for="putanja-slike">Slika</label>
                    </div>

                    <button class="btn btn-outline-success btn-lg px-5" type="submit">Dodaj temu</button>


                    </div>
                </form>
                <p>
                    <a href="../utils/logout.php">Izloguj se</a>
                </p>
            </div>
            
            </div>        
        </div>
        </div>
    </div>
    
</body>
</html>