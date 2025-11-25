<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Erreur 404 – Page introuvable</title>
    <style>
        /* === Ton CSS existant réutilisé tel quel === */

        /* ===== Style spécifique à la page 404 ===== */
        .error-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 60px;
            text-align: center;
            animation: fadeIn 0.6s ease;
        }

        .error-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            max-width: 420px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            animation: floating 2s ease-in-out infinite;
        }

        .error-title {
            font-size: 3rem;
            margin-bottom: 10px;
            color: #e74c3c;
            font-weight: 700;
        }

        .error-subtitle {
            font-size: 1.3rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .error-text {
            font-size: 1rem;
            color: #555;
            margin-bottom: 25px;
        }

        .btn-back {
            background-color: #3498db;
            color: #fff;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .btn-back:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(52,152,219,0.25);
        }

        @keyframes floating {
            0% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
            100% { transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
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
