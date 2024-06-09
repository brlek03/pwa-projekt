<?php 
    include "connect.php";

    $query = "SELECT * FROM clanci WHERE arhiva = 0 ORDER BY datum desc;";
    $result = $dbc->query($query);

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
        <section class="news">
            <h1>Udarne vijesti</h1>
            <div class="articles news">
                <?php while ($row = $result->fetch_assoc()) : ?>
                <article class="article">
                    <img src="<?php echo $row['slika']; ?>" alt="Vijest">
                    <p><?php echo $row['sazetak']; ?></p>
                </article>
                <?php endwhile; ?>
            </div>
        </section>
        <section class="jt">
            <h1>Les JT</h1>
            <div class="articles jt">
                <article class="article">
                    <img src="img-index/weather-1.jpg" alt="JT Image">
                    <p>JT de 8h du vendredi 17 mai 2019</p>
                </article>
                <article class="article">
                    <img src="img-index/weather-2.jpg" alt="JT Image">
                    <p>Grand Soir 3 du jeudi 16 mai 2019</p>
                </article>
                <article class="article">
                    <img src="img-index/weather-3.png" alt="JT Image">
                    <p>JT de 20h du jeudi 16 mai 2019</p>
                </article>
                <article class="article">
                    <img src="img-index/weather-4.jpg" alt="JT Image">
                    <p>Le JT de 7h de franceinfo du vendredi 17 mai 2019</p>
                </article>
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
