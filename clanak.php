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
    <title>INFO FRANCEINFO</title>
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
            <h1>INFO FRANCEINFO. Européennes: les Républicains et le RN n'ont pas signé le plaidoyer de Transparency International pour la lutte contre la corruption</h1>
            <img src="img-index/euparliamente.jpg" alt="European Parliament">
            <p>149 candidats français d'autres partis l'ont signé, dont sept têtes de listes, selon l'ONG.</p>
            <p>Dans le cadre des élections européennes, l'ONG Transparency International, qui lutte contre la corruption, a invité tous les candidats à signer un plaidoyer afin qu'ils s'engagent à protéger l'État de droit, à lutter contre l'évasion fiscale et à améliorer la transparence des institutions européennes.</p>
            <p>Suite à un premier bilan effectué par l'ONG, pour le moment, 149 candidats aux élections européennes en France ont signé ce plaidoyer, révèle franceinfo vendredi 17 mai. Parmi ces candidats qui s'engagent, on retrouve sept têtes de liste aux européennes (La France insoumise, Renaissance, Parti communiste, Europe Écologie-Les Verts, Debout la France, Envie d'Europe et Parti Pirate). Aucun candidat des listes du Rassemblement national et des Républicains ne figure parmi ce groupe. Or, ces deux listes regroupent à elles seules 40% des candidats en position éligible.</p>
            <h2>"Encore des gens à convaincre"</h2>
            <p>Dans sa réponse à franceinfo, Jordan Bardella, tête de liste RN, exprime des "désaccords de fond" avec les propositions de l'ONG. La liste Les Républicains, elle, explique n'avoir "pas toujours été en phase avec les recommandations d'un sommaire de principe de la déontologie et à l'État de droit. Ce sont "des partis qui n'ont pas toujours été en phase avec nos suggestions" affirme sur franceinfo Marc-André Feffer, le président de l'ONG Transparency International. "Et ce, soit pour des raisons liées à l'Union européenne, soit liées au sujet de l'engagement qu'ils privilégient finalement la déontologie individuelle."</p>
            <p>Toutefois, "le verre est plus qu'à moitié plein" estime Marc-André Feffer. Sur les 2 686 candidats aux européennes, 149 ont signé le plaidoyer. "Ceux qui ont répondu positivement nous aident beaucoup. Il y a encore des gens à convaincre, nous souhaitons qu'il y ait un effet de masse critique sur ces questions-là."</p>
            <p>Courant mai, l'ONG Transparency International a réalisé un sondage auprès de la population qui révèle que 88% des Français jugent prioritaire le renforcement de l'éthique et la transparence dans les institutions européennes.</p>
        </article>
    </main>
    <footer>
        <div class="container">
            <p class="footer-text">france.tv</p>
        </div>
    </footer>
</body>
</html>