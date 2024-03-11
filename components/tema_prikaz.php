<?php
    include "../database/konekcija.php";
    
    //Ovaj kod se koristi za prikaz svih diskusija na stranici tema
    
    $sql = "SELECT * FROM diskusije WHERE id_teme ='".$idTeme."'";
    $results = $conn->query($sql);

    if ($results->num_rows > 0)
    while($row = $results->fetch_assoc()) {

        $idDiskusije = $row["id"];
        echo "
            <h3><a href = '../pages/diskusija.php?id_diskusije=$idDiskusije'>
            ".$row["naslov"]."
            </a></h3>
            <p>
            ".$row["text"]."
            </p>
        ";
        
    }
    else{
        echo "Nema diskusija";
    }
    $conn->close();

    ?>
    <script></script>