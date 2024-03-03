<?php

require_once "konekcija.php";

$ime = "viktor";
$lozinka = "VicoLol123";

$hashLozinka = password_hash($lozinka,PASSWORD_DEFAULT);

$sql = "INSERT INTO admini (ime,lozinka) VALUES (?,?)";

$run = $conn->prepare($sql);
$run -> bind_param("ss",$ime,$hashLozinka);

$run->execute();