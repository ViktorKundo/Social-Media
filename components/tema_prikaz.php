<?php
    include "../database/konekcija.php";
    
    //Ovaj kod se koristi za prikaz svih diskusija na stranici tema
    
    $sql = "SELECT * FROM diskusije WHERE id_teme ='".$idTeme."'";
    $results = $conn->query($sql);

    if ($results->num_rows > 0)
    while($row = $results->fetch_assoc()) {

        $id_diskusije = $row["id"];
        echo "
            <h3><a href = '../pages/diskusija.php?id_diskusije=$id_diskusije'>
            ".$row["naslov"]."
            </a></h3>
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
    $conn->close();

    ?>
    <script></script>