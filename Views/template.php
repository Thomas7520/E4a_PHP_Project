<?php

use Helpers\Toast;

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="../public/css/main.css"/>
    <link rel="stylesheet" href="../public/css/template.css"/>
    <link rel="stylesheet" href="../public/css/toast.css"/>
    <link rel="stylesheet" href="../public/css/add-perso.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>
</head>
<body>

<header>

    <nav class="navbar">
        <ul>
            <li>
                <a href="./index.php">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M3 11.5L12 4l9 7.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1v-8.5z"/>
                    </svg>
                    Accueil
                </a>
            </li>
            <li>
                <a href="./index.php?action=add-perso">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M11 11V6h2v5h5v2h-5v5h-2v-5H6v-2h5z"/>
                    </svg>
                    Ajouter un personnage
                </a>
            </li>
            <li>
                <a href="./index.php?action=add-perso-element">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M12 2L15.09 8.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01L12 2z"/>
                    </svg>
                    Ajouter un élément
                </a>
            </li>
            <li>
                <a href="./index.php?action=logs">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm-2 14H7v-2h10v2zm0-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                    </svg>
                    Logs
                </a>
            </li>
            <li>
                <a href="./index.php?action=login">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M10 17l5-5-5-5v3H3v4h7v3zm9-12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-3h2v3h11V7H8v3H6V7a2 2 0 0 1 2-2h11z"/>
                    </svg>
                    Connexion
                </a>
            </li>
        </ul>
    </nav>
</header>

<?php


Toast::render(); ?>

<!-- #contenu -->
<main id="contenu">
    <?= $this->section('content') ?>
</main>

<footer>
    <p style="text-align:center; color:#777; font-size:0.9em; margin-top:30px;">
        &copy; <?= date('Y') ?> - Mihoyo Collection
    </p>
</footer>

</body>
</html>
