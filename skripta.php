<?php 
    include "connect.php";

    if (isset($_POST['naslov']) 
        && isset($_POST['sazetak']) 
        && isset($_POST['tekst'])
        && isset($_POST['kategorija']) 
        && isset($_FILES['slika'])) {
            
            $arhiva = 1;
            $naslov = $_POST['naslov'];
            $sazetak = $_POST['sazetak'];
            $kategorija =  $_POST['kategorija'];
            $tekst = $_POST['tekst'];
            
            $imgDir = "img-index/";
            $uploadedImg = $imgDir . basename($_FILES["slika"]["name"]);
            move_uploaded_file($_FILES["slika"]["tmp_name"], $uploadedImg);
            $slika = $uploadedImg;

            if (isset($_POST['prikazi'])) {
                $arhiva = 0;
            }

            $insert = $dbc->prepare("INSERT INTO clanci (naslov, sazetak, tekst, kategorija, slika, arhiva) 
                                    VALUES (?,?,?,?,?,?)");
            $insert->bind_param("sssssi", $naslov, $sazetak, $tekst, $kategorija, $slika, $arhiva);
            $insert->execute();
            $insert->close();
            
    } else {
        $message = "Greška: nepotpun obrazac.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $naslov; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div>
            <div class="logo">
                <img src="img-index/Franceinfo.png" alt="Franceinfo Logo">
            </div>
            <nav>
                <ul>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="kategorija.php?id=Politika">Politika</a></li>
                    <li><a href="kategorija.php?id=Sport">Sport</a></li>
                    <li><a href="unos.php">Unos</a></li>
                    <li><a href="administracija.php">Administracija</a></li>
                </ul>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">
        <article class="news-article">
            <br>
            <h2><?php echo $kategorija; ?></h1>
            <h1><?php echo $naslov; ?></h1> <br>
            <?php echo "<img src='$slika'"; ?> <br>
            <i><?php echo $sazetak; ?></i> <br><br>
            <p><?php echo $tekst; ?> <br>
        </article>
    </main>
    <footer>
        <div class="container">
            <p class="footer-text">france.tv</p>
        </div>
    </footer>
</body>
</html>

