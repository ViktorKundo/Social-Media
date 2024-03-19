
<section class="mt-4">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <?php
                include "../database/konekcija.php";
                
                //Ovaj kod se koristi za prikaz svih diskusija na stranici tema
                
                $sql = "SELECT * FROM teme WHERE id_teme LIKE $idTeme";
                $results = $conn->query($sql);
                
                if ($results->num_rows > 0)
                while($row = $results->fetch_assoc()) {

                echo '
                <div class = "col-lg-4 sm-12 text-sm-center">
                    <img class="slikaTema-d" src=..'.$row["putanjaSlike"].'>
                </div>
                <div class="col-lg-6 col-sm-12 text-sm-">
                    <h3 class="text-center">
                    '.$row["naslov"]."
                    </h3>
                    <p>
                    ".$row["opis"]."
                    </p>
                </div>
                ";

                }

                ?>
        </div>
    </div>
</section>
<main>
    <div class="container">
        <div class="row align-items-center  border border-success p-3">
            

            <?php
                
                //Ovaj kod se koristi za prikaz svih diskusija na stranici tema
                
                $sql = "SELECT * FROM diskusije WHERE id_teme LIKE $idTeme";
                $results = $conn->query($sql);
                
                if ($results->num_rows > 0)
                while($row = $results->fetch_assoc()) {

                $idDiskusije = $row["id"];
                echo "
                <div class = 'col-md-2 col- sm-9 mx-0 px-0'>
                    <img class='slikaDiskusija' src='..".$row["putanjaSlike"]."'>
                </div>
                <div class='col-md-3 col-sm-12 m-0 px-0'>
                    <h3><a href = '../pages/diskusija.php?id_diskusije=$idDiskusije'>
                    ".$row["naslov"]."
                    </a></h3>
                    <p>
                    ".$row["text"]."
                    </p>
                </div>
                ";

                }
                else{
                    echo "Nema diskusija";
                }
                $conn->close();

                ?>
            <script></script>
        </div>
    </div>
</main>