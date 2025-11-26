<?php

use Services\AuthService;

$this->layout('template', ['title' => 'Connexion']);
?>

<div class="form-container">
    <?php if (AuthService::isLogged()):
        $username = $_SESSION['username'] ?? 'Utilisateur';
        $remaining = ($_SESSION['timeout'] ?? time()) - time();
        $minutes = floor($remaining / 60);
        $seconds = $remaining % 60;
        ?>
        <h2>Bienvenue, <?= htmlspecialchars($username) ?> !</h2>
        <p>Temps de session restant : <?= $minutes ?> min <?= $seconds ?> s</p>
        <a href="./index.php?action=logout"><button>Se déconnecter</button></a>
    <?php else: ?>
        <h2>Connexion</h2>
        <form method="POST" action="./index.php?action=login">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Se connecter</button>
        </form>
    <?php endif; ?>
</div>
