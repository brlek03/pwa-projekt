<?php 
    include "connect.php";

    $id = $_GET['id'];
    $query = "SELECT * FROM clanci WHERE id = ?";
    $stmt = $dbc->prepare($stmt);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['naslov']; ?></title>
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
            <h2><?php echo $row['kategorija']?></h2>
            <h1><?php echo $row['naslov']?></h1>
            <img src="<?php echo $row['slika']?>">
            <p><?php echo $row['sazetak']?></p>
            <p><?php echo $row['tekst']?></p>
        </article>
    </main>
    <footer>
        <div class="container">
            <p class="footer-text">france.tv</p>
        </div>
    </footer>
</body>
</html>
