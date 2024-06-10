<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos</title>
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
                    <li><a href="unos.html">Unos</a></li>
                    <li><a href="#">Administration</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">
        <section class="news">
            <h1>Unos</h1>
            <form action="skripta.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="naslov">Naslov vijesti:</label>
                    <input type="text" id="naslov" name="naslov" required>
                </div>
                <div class="form-group">
                    <label for="sazetak">Kratki sažetak (do 50 znakova):</label>
                    <textarea id="sazetak" name="sazetak" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="tekst">Tekst vijesti:</label>
                    <textarea id="tekst" name="tekst" rows="8" required></textarea>
                </div>
                <div class="form-group">
                    <label for="kategorija">Kategorija vijesti:</label>
                    <select id="kategorija" name="kategorija" required>
                        <option value="Politika">Politika</option>
                        <option value="Sport">Sport</option>
                        <option value="Zabava">Zabava</option>
                        <option value="Tehnologija">Tehnologija</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="slika">Odabir slike:</label>
                    <input type="file" id="slika" name="slika" accept="image/*">
                </div>
                <div class="form-group checkbox-group">
                    <input type="checkbox" id="prikazi" name="prikazi">
                    <label for="prikazi">Prikaži vijest na stranici</label>
                </div>
                <div class="form-group">
                    <button type="submit">Pošalji</button>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <div class="container">
            <p class="footer-text">france.tv</p>
        </div>
    </footer>
</body>
</html>
