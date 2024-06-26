<?php
include "connect.php";

$kategorija = $_GET['id'];
$query = "SELECT * FROM clanci WHERE arhiva=0 AND kategorija=?";
$stmt = $dbc->prepare($query);
$stmt->bind_param("s", $kategorija);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $kategorija; ?></title>
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
            <h1><?php echo $kategorija; ?></h1>
            <div class="articles news">
                <?php while ($row = $result->fetch_assoc()): ?>
                <article class="article">
                    <a href="<?php echo 'clanak.php?id=' . $row['id']?>"><h1><?php echo $row['naslov'] ?></h1></a>
                    <img src="<?php echo $row['slika']; ?>" alt="News Image">
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
