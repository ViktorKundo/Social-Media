<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pocetna</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="./css/style.css" type="text/css">

</head>
<body>
    <div id="root">
        <?php
        require_once "components/navbar_index.php";
        ?>
        <main>
            <div class="container">
                <div class="row align-items-center  border border-success">

                    <?php 
                    include "database/konekcija.php";
                    $sql = "SELECT * FROM teme";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        
                        while($row = $result->fetch_assoc()) {
                            $idTeme = $row["id_teme"];
                            $_SESSION["id_teme"] = $idTeme;
                            echo "
                            <div class='col-md-2 col-sm-3 '>
                                <img class='slikaTema' src=".$row["putanjaSlike"].">
                            </div>
                            <div class='col-md-4 col-sm-7 '>
                                <a href = 'pages/tema.php?id_teme=$idTeme'><h3>
                                ".$row["naslov"]."
                                </h3></a>
                                <p>
                                ".substr($row["opis"],0,80)."...
                                </p><hr><br>
                            </div>";
                        }
                    } else {
                        echo "<h4>Nema tema</h4>";
                    }
                    $conn->close();
                ?>
            
                </div>            
            </div>
        </main> 
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>