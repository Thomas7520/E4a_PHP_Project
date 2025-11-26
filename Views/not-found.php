<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Erreur 404 – Page introuvable</title>
    <link rel="stylesheet" href="../public/css/not-found.css"/>

</head>

<body>
<div class="error-wrapper">

    <div class="error-card">
        <h1 class="error-title">404</h1>
        <h2 class="error-subtitle">Page introuvable</h2>
        <p class="error-text">
            Oups… Le personnage ou la page que vous cherchez n’existe pas.
            <br>Elle a peut-être été supprimée ou déplacée.
        </p>
        <a href="./index.php" class="btn-back">⬅ Retour à l’accueil</a>
    </div>

</div>
</body>
</html>
