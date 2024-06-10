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
                    <li><a href="unos.php">Unos</a></li>
                    <li><a href="administracija.php">Administracija</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">
        <section class="news">
            <h1>Unos</h1>
            <form id="unosClanka" action="skripta.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="naslov">Naslov vijesti:</label>
                    <input type="text" id="naslov" name="naslov">
                    <span class="error" id="naslovError"></span>
                </div>
                <div class="form-group">
                    <label for="sazetak">Sažetak:</label>
                    <textarea id="sazetak" name="sazetak" rows="4"></textarea>
                    <span class="error" id="sazetakError"></span>
                </div>
                <div class="form-group">
                    <label for="tekst">Tekst vijesti:</label>
                    <textarea id="tekst" name="tekst" rows="8"></textarea>
                    <span class="error" id="tekstError"></span>
                </div>
                <div class="form-group">
                    <label for="kategorija">Kategorija vijesti:</label>
                    <select id="kategorija" name="kategorija">
                        <option value="Politika">Politika</option>
                        <option value="Sport">Sport</option>
                        <option value="Zabava">Zabava</option>
                        <option value="Tehnologija">Tehnologija</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="slika">Odabir slike:</label>
                    <input type="file" id="slika" name="slika" accept="image/*">
                    <span class="error" id="slikaError"></span>
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
<script type="text/javascript">
    document.getElementById('unosClanka').addEventListener('submit', function(event){
        event.preventDefault();

        var uvjeti = true;

        document.querySelectorAll('.error').forEach(el => el.innerText = '');
        document.querySelectorAll('input').forEach(el => el.style.border = "1px solid #ccc");
        document.querySelectorAll('textarea').forEach(el => el.style.border = "1px solid #ccc");

        var naslov = document.getElementById('naslov').value;

        if (naslov.length < 5 || naslov.length > 30){
            uvjeti = false;
            document.getElementById('naslovError').innerText = 'Naslov mora između 5 do 30 znakova';
            document.getElementById("naslov").style.border = "1px solid red";
        };

        var sazetak = document.getElementById('sazetak').value;

        if (sazetak.length < 10 || sazetak.length > 100){
            uvjeti = false;
            document.getElementById('sazetakError').innerText = 'Kratki sadržaj mora imati između 10 i 100 znakova';
            document.getElementById("sazetak").style.border = "1px solid red";
        };

        var tekst = document.getElementById('tekst').value;

        if (tekst.length === 0){
            uvjeti = false;
            document.getElementById('tekstError').innerText = 'Tekst ne smije biti prazan';
            document.getElementById("tekst").style.border = "1px solid red";
        };

        var slika = document.getElementById('slika').value;

        if (slika.length === 0){
            uvjeti = false;
            document.getElementById('slikaError').innerText = 'Slika mora biti prenesena';
            document.getElementById("slika").style.border = "1px solid red";
        };

        if (uvjeti) this.submit();
    });
</script>
</html>

