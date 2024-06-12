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
    <title>Registracija</title>
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
        <form name="registracija" method="POST" action="registracija.php">
            <label for="ime">Ime:</label>
            <input type="text" id="ime" name="ime">
            <span class="error" id="imeError"></span>
            <br>
            <label for="prezime">Prezime:</label>
            <input type="text" id="prezime" name="prezime">
            <span class="error" id="prezimeError"></span>
            <br>
            <label for="username">Korisničko ime:</label>
            <input type="text" id="username" name="username">
            <span class="error" id="usernameError"></span>
            <br>
            <label for="pass">Lozinka:</label>
            <input type="password" id="pass" name="pass">
            <span class="error" id="passError"></span>
            <br>
            <label for="passRep">Ponovite lozinku:</label>
            <input type="password" id="passRep" name="passRep">
            <span class="error" id="passRepError"></span>
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
<script type="text/javascript">
    document.forms['registracija'].addEventListener('submit', function(event){
        event.preventDefault();

        var uvjeti = true;

        document.querySelectorAll('.error').forEach(el => el.innerText = '');
        document.querySelectorAll('input').forEach(el => el.style.border = "1px solid #ccc");

        var ime = document.getElementById('ime').value;

        if (ime.length < 2 || ime.length > 20){
            uvjeti = false;
            document.getElementById('imeError').innerText = 'Ime mora sadržavati 2 do 20 znakova';
            document.getElementById("ime").style.border = "1px solid red";
        };

        var prezime = document.getElementById('prezime').value;

        if (prezime.length < 2 || prezime.length > 35){
            uvjeti = false;
            document.getElementById('prezimeError').innerText = 'Prezime mora sadržavati 2 do 35 znakova';
            document.getElementById("prezime").style.border = "1px solid red";
        };

        var username = document.getElementById('username').value;

        if (username.length < 5 || username.length > 20){
            uvjeti = false;
            document.getElementById('usernameError').innerText = 'Korisničko ime mora sadržavati 5 do 20 znakova';
            document.getElementById("username").style.border = "1px solid red";
        };

        var pass = document.getElementById('pass').value;

        if (pass.length < 6 || pass.length > 20){
            uvjeti = false;
            document.getElementById('passError').innerText = 'Lozinka mora sadržavati 6 do 20 znakova';
            document.getElementById("pass").style.border = "1px solid red";
        };

        var passRep = document.getElementById('passRep').value;

        if (passRep != pass) {
            uvjeti = false;
            document.getElementById("passRepError").innerText = 'Lozinka se moraju podudarati';
            document.getElementById("passRep").style.border = "1px solid red";
        };

        if (uvjeti) this.submit();
    });
</script>
</html>
