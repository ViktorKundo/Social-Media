<?php

session_start();

if(!isset($_SESSION["adminIme"])){
    header("Location: index.php");
    exit();
}
   
echo "Uspešno si se ulogovao";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
        <label>Naslov: </label>
        <input type = "text" name = "naslov" value = ""><span class = "error"><?php echo $naslovInput; ?></span><br>
        <label>Opis: </label>
        <textarea name = "opis" ></textarea><span class = "error"><?php echo $opisInput; ?></span><br>
        <label>Slika: </label>
        <input type = "hidden" name = "putanjaSlike" id="putanjaSlikeInput"><br>

        <div id="dropzone-upload" class="dropzone"></div>

        <input type = "submit" value = "Kreiraj"></textarea>
    </form>
</body>
</html>