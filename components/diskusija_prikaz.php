<?php
    require_once "../database/konekcija.php";
    
    //Ovaj kod se koristi za detaljan prikaz diskusije 
    
    $sql = "SELECT * FROM diskusije WHERE id = $idDiskusije";
    $results = $conn->query($sql);

    if ($results->num_rows == 1){
        $row = $results->fetch_assoc();
        echo "
            <h1>
            ".$row["naslov"]."
            </h1>
            <p>
            ".$row["text"]."
            </p>
            <p>
            ".$row["korisnicko_ime"]."
            </p>
            <p>
            ".$row["kreirana"]."
            </p>
        ";
        
        
    }
    else{
        echo "Nema diskusija";
    }

    ?>