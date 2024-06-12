<?php
session_start();
include 'connect.php';

if (isset($_POST['prijava'])) {
    $prijavaUsername = $_POST['username'];
    $prijavaPassword = $_POST['lozinka'];

    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = $dbc->prepare($sql);
    $stmt->bind_param("s", $prijavaUsername);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($username, $password, $level);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($prijavaPassword, $password)) {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $level;

        if ($level != 1) {
            echo "Nemate administratorske ovlasti";
            $stmt->close();
            exit();
        }
    } else {
        echo "Pogrešno ime ili lozinka";
        $stmt->close();
        exit();
    }
    $stmt->close();
}

if (isset($_SESSION['username']) && $_SESSION['level'] == 1) {

    if (isset($_POST['delete'])) {
        $id = intval($_POST['id']);
        $query = "DELETE FROM clanci WHERE id=?";
        $stmt = $dbc->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST['update'])) {
        $id = intval($_POST['id']);
        $naslov = $_POST['naslov'];
        $sazetak = $_POST['sazetak'];
        $tekst = $_POST['tekst'];
        $kategorija = $_POST['kategorija'];
        $arhiva = isset($_POST['arhiva']) ? 1 : 0;

        $picture = $_FILES['slika']['name'];
        if ($picture) {
            $target_dir = 'img-index/' . $picture;
            move_uploaded_file($_FILES["slika"]["tmp_name"], $target_dir);
        } else {
            $target_dir = $_POST['existing_slika'];
        }

        $query = "UPDATE clanci SET naslov=?, sazetak=?, tekst=?, kategorija=?, slika=?, arhiva=? WHERE id=?";
        $stmt = $dbc->prepare($query);
        $stmt->bind_param("ssssssi", $naslov, $sazetak, $tekst, $kategorija, $target_dir, $arhiva, $id);
        $stmt->execute();
        $stmt->close();
    }

    $query = "SELECT * FROM clanci ORDER BY datum DESC";
    $result = $dbc->query($query);
    ?>
    <!DOCTYPE html>
    <html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administracija</title>
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
            <section class="admin">
                <h1>Administracija članaka</h1>
                <div class="articles admin">
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <form action="administracija.php" method="POST" enctype="multipart/form-data">
                        <article class="article">
                            <div>
                                <label for="naslov">Naslov:</label>
                                <input type="text" name="naslov" value="<?php echo htmlspecialchars($row['naslov']); ?>" required>
                            </div>
                            <br>
                            <div>
                                <label for="sazetak">Sažetak:</label><br>
                                <textarea name="sazetak" rows="2" required><?php echo htmlspecialchars($row['sazetak']); ?></textarea>
                            </div>
                            <br>
                            <div>
                                <label for="tekst">Tekst:</label><br>
                                <textarea name="tekst" rows="5" required><?php echo htmlspecialchars($row['tekst']); ?></textarea>
                            </div>
                            <br>
                            <div>
                                <label for="kategorija">Kategorija:</label>
                                <select name="kategorija" required>
                                    <option value="Politika" <?php if ($row['kategorija'] == 'Politika') echo 'selected'; ?>>Politika</option>
                                    <option value="Sport" <?php if ($row['kategorija'] == 'Sport') echo 'selected'; ?>>Sport</option>
                                    <option value="Zabava" <?php if ($row['kategorija'] == 'Zabava') echo 'selected'; ?>>Zabava</option>
                                    <option value="Tehnologija" <?php if ($row['kategorija'] == 'Tehnologija') echo 'selected'; ?>>Tehnologija</option>
                                </select>
                            </div>
                            <br>
                            <div>
                                <label for="slika">Slika:</label><br>
                                <input type="file" name="slika" accept="image/*"><br><br>
                                <img src="<?php echo htmlspecialchars($row['slika']); ?>" width="100px">
                                <input type="hidden" name="existing_slika" value="<?php echo htmlspecialchars($row['slika']); ?>">
                            </div>
                            <br>
                            <div>
                                <label for="arhiva">Arhiva:</label>
                                <input type="checkbox" name="arhiva" <?php if ($row['arhiva']) echo 'checked'; ?>>
                            </div>
                            <br>
                            <div>
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="update">Izmjeni</button>
                                <button type="submit" name="delete">Izbriši</button>
                            </div>
                        </article>
                    </form>
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
    <?php
} else {
    // Prikaz forme za prijavu 
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administracija</title>
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
            <h1>Prijava</h1>
            <form name='prijava' method="POST">
                <label for="username">Korisničko ime:</label>
                <input type="text" id="username" name="username">
                <label for="lozinka">Lozinka:</label>
                <input type="password" id="lozinka" name="lozinka">
                <button type="submit" name="prijava">Prijava</button>
            </form>
            <br>
            <a href="registracija.php">Registracija</a>
            </section>
        </main>
        <footer>
            <div class="container">
                <p class="footer-text">france.tv</p>
            </div>
        </footer>
    </body>
    </html>
    <?php
}
?>
