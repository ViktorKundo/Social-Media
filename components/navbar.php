<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item ms-5">
                    <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php#Teme">Teme</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Nalog
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php
                    if(!isset($_SESSION['email']) && !isset($_SESSION['adminIme'])){
                        
                        echo '<li><a class="dropdown-item" href="../pages/registracija.php">Registracija</a></li>';
                        echo '<li><a class="dropdown-item" href="../pages/prijava_korisnik.php">Prijava</a></li>';
                        echo '<li><a class="dropdown-item" href="../pages/prijava_admin.php">Prijava kao admin</a></li>';
                    } else {
                        
                        $email = $_SESSION["email"];
                        $prikazIme = $_SESSION["ime_prikaz"];
                        
                        echo '
                        
                        <li><a class="dropdown-item" href="../utils/logout.php">Logout</a></li>
                        
                        ';
                        
                    }
                    
                    ?>
                    </ul>
                    
                </li>
            </ul>
                <?php
                if(!isset($_SESSION['email']) && !isset($_SESSION['adminIme'])){
                    echo '<div class="d-flex w-auto me-5">
                            <a class="nav-link " href="../pages/prijava_korisnik.php">Nisi ulogovan</a>
                        </div>';

                }
                else {
                    echo '<div class="d-flex w-auto me-5">
                            <p>Dobro dosao </p>'.$prikazIme.'
                        </div>';
                }
                ?>
        </div>
    </div>
</nav>