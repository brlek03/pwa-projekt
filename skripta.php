<?php 
    if (isset($_POST['prikazi']) 
        && isset($_POST['naslov']) 
        && isset($_POST['sazetak']) 
        && isset($_POST['tekst'])
        && isset($_POST['kategorija']) 
        && isset($_FILES['slika'])) {

            $naslov = $_POST['naslov'];
            $sazetak = $_POST['sazetak'];
            $kategorija =  $_POST['kategorija'];
            $tekst = $_POST['tekst'];
            
            $imgDir = "img-index/";
            $uploadedImg = $imgDir . basename($_FILES["slika"]["name"]);
            move_uploaded_file($_FILES["slika"]["tmp_name"], $uploadedImg);
            $slika = $uploadedImg;
            
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
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">Elections</a></li>
                    <li><a href="#">Les JT</a></li>
                    <li><a href="unos.html">Unos</a></li>
                    <li><a href="#">Administration</a></li>
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

