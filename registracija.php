<?php
include 'connect.php';

$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $lozinka = $_POST['pass'];
    $lozinkaRep = $_POST['passRep'];

    if ($lozinka !== $lozinkaRep) {
        $msg = 'Lozinke se ne podudaraju!';
    } else {
        $hashed_password = password_hash($lozinka, PASSWORD_BCRYPT);
        $razina = 0;

        $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = $dbc->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $msg = 'Korisničko ime već postoji!';
        } else {
            $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
            $stmt = $dbc->prepare($sql);
            $stmt->bind_param('ssssd', $ime, $prezime, $username, $hashed_password, $razina);
            if ($stmt->execute()) {
                $msg = 'Korisnik je uspješno registriran!';
            } else {
                $msg = 'Došlo je do pogreške prilikom registracije.';
            }
        }
        $stmt->close();
    }
    $dbc->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <link rel="stylesheet" href="style.css">
    <style>
        a {
        display: inline-block;
        text-align: center;
        margin: 20px 0;
        color: black;
        text-decoration: none;
        font-size: 16px;
        }   

        a:hover {
        color: blue;
        }
    </style>
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
        <h1>Registracija</h1>
        <form method="POST" action="registracija.php">
            <label for="ime">Ime:</label>
            <input type="text" id="ime" name="ime" required>
            <br>
            <label for="prezime">Prezime:</label>
            <input type="text" id="prezime" name="prezime" required>
            <br>
            <label for="username">Korisničko ime:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="pass">Lozinka:</label>
            <input type="password" id="pass" name="pass" required>
            <br>
            <label for="passRep">Ponovite lozinku:</label>
            <input type="password" id="passRep" name="passRep" required>
            <br>
            <button type="submit">Registracija</button>
        </form>
        <br>
        <p><?php echo $msg; ?></p>
        <a href="administracija.php">Prijava</a>
        </section>
    </main>
    <footer>
        <div class="container">
            <p class="footer-text">france.tv</p>
        </div>
    </footer>
</body>
</html>
