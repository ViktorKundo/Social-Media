
<main>
    <div class="container">
        <div class="row align-items-center justify-content-center border border-success">
            <?php
                require_once "../database/konekcija.php";
                
                //Ovaj kod se koristi za detaljan prikaz diskusije 
                
                $sql = "SELECT * FROM diskusije WHERE id = $idDiskusije";
                $results = $conn->query($sql);

                if ($results->num_rows == 1){
                    $row = $results->fetch_assoc();
                    echo "
                    <div class='col-8'>
                        <h1 class='text-center'>
                        ".$row["naslov"]."
                        </h1>
                        <p>
                        ".$row["text"]."
                        </p>
                    </div>
                    <div class='col-12 text-center'>
                        <img class='slikaDiskusija-d' src ='..".$row["putanjaSlike"]."'>
                    </div>
                        <p>
                            Kreator: ".$row["korisnicko_ime"]."
                        </p>
                        <p>
                        Datum i vreme kreiranja: ".$row["kreirana"]."
                        </p>
                    ";
                    
                    
                }
                else{
                    echo "Nema diskusija";
                }

        ?>
        
