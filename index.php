<?php 
    include "connect.php";

    $queryPolitika = "SELECT * FROM clanci WHERE kategorija = 'Politika' AND arhiva = 0 ORDER BY datum desc;";
    $resultPolitika = $dbc->query($queryPolitika);

    $querySport = "SELECT * FROM clanci WHERE kategorija = 'Sport' AND arhiva = 0 ORDER BY datum desc;";
    $resultSport = $dbc->query($querySport);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Franceinfo</title>
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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="kategorija.php?id=Politika">Politika</a></li>
                    <li><a href="kategorija.php?id=Sport">Sport</a></li>
                    <li><a href="unos.php">Unos</a></li>
                    <li><a href="administracija.php">Administracija</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">
        <section class="news">
            <h1>Politika</h1>
            <div class="articles news">
                <?php while ($row = $resultPolitika->fetch_assoc()) : ?>
                <article class="article">
                    <a href="<?php echo 'clanak.php?id=' . $row['id']?>"><h1><?php echo $row['naslov'] ?></h1></a>
                    <img src="<?php echo $row['slika']; ?>" alt="Vijest">
                    <p><?php echo $row['sazetak']; ?></p>
                </article>
                <?php endwhile; ?>
            </div>
        </section>
        <section class="jt">
            <h1>Sport</h1>
            <div class="articles jt">
                <?php while ($row = $resultSport->fetch_assoc()) : ?>
                <article class="article">
                    <a href="<?php echo 'clanak.php?id=' . $row['id']?>"><h1><?php echo $row['naslov'] ?></h1></a>
                    <img src="<?php echo $row['slika']; ?>">
                    <p><?php echo $row['sazetak']; ?></p>
                </article>
                <?php endwhile; ?>
            </div>
        </section>
    </main>
    <footer>
        <div class="container">
            <p class="footer-text">france.tv</p>
        </div>
    </footer>
</body>
</html>
