<?php
    include "../database/konekcija.php";
    
    //Ovaj kod se koristi za prikaz svih diskusija na stranici tema
    
    $sql = "SELECT * FROM diskusije WHERE id_teme ='".$idTeme."'";
    $results = $conn->query($sql);

    if ($results->num_rows > 0)
    while($row = $results->fetch_assoc()) {
        echo "
            <h3>
            ".$row["naslov"]."
            </h3
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
    $conn->close();

    ?>