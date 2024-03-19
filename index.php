<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Debate It</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="./css/style.css" type="text/css">

</head>
<body>
    <div id="root">
        <?php
        require_once "components/navbar_index.php";
        ?>
        <section>
            <div class="container mt-5">
                <h2 class="text-center">Dobro došli na Debate It</h2>
                <p class="mt-5">
                    Da li ste ikada želeli da iznesete svoje mišljenje o aktuelnim događajima, debatama ili interesantnim temama, ali niste znali gde? Sada imate priliku da se pridružite živoj i angažovanoj zajednici na Debate it.
                </p>
                <p>
                    Debate it je sveobuhvatna platforma za diskusiju koja okuplja ljude iz celog sveta kako bi razmenjivali ideje, stavove i argumente o raznim temama. Bez obzira da li vas interesuju politika, nauka, tehnologija, umetnost ili bilo koja druga oblast, Debate it pruža prostor za konstruktivnu raspravu.
                </p>
                <p>Šta Debate it čini posebnim?</p>
                <ol>
                    <li><b>Raznovrsnost Tema:</b> Na Debate it možete pronaći širok spektar tema za diskusiju. Od globalnih političkih događaja do lokalnih interesnih grupa, svako može pronaći nešto što ga zanima.
                
                    <li><b>Kvalitetna Rasprava:</b> Debate it teži stvaranju atmosfere u kojoj se cene argumenti zasnovani na činjenicama i logici. Korisnici su ohrabreni da doprinose konstruktivnoj diskusiji i da poštuju različite tačke gledišta.
                
                    <li><b>Zajednica Bezbednosti:</b> Bezbednost i privatnost korisnika su prioriteti na Debate it. Moderatori pažljivo nadgledaju sadržaj i aktivnosti kako bi osigurali da se svi osećaju dobrodošlo i poštovano.
                
                    <li><b>Prilagođeno Korisničko Iskustvo:</b> Korisnički interfejs je intuitivan i prilagođen kako bi svako mogao lako da se pridruži diskusijama. Osim toga, Debate it pruža mogućnost personalizacije korisničkog iskustva prema vašim interesima.
                </ol>

                <p>
                    Pridružite se Debate it i budite deo dinamične zajednice koja inspiriše promišljenu razmenu ideja i stavova. Bez obzira da li želite da naučite nešto novo, iznesete svoje mišljenje ili jednostavno upoznate nove ljude, Debate it je mesto za vas.
                </p>
                <p>
                    Posetite Debate it danas i započnite svoju diskusionu avanturu!
                </p>
            </div>
        </section>
        <main>
            <div class="container">
                    <h2 class="text-center" id="Teme">TEME</h2>
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
                            <div class='col-md-4 col-sm-7 pt-3'>
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