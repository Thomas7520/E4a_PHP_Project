<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Logger;
use Services\AuthService;
use function Helpers\toast;

class LoginController
{
    private Engine $templates;
    private Logger $logger;
    private MainController $mainController;

    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
        $this->logger = new Logger();
        $this->templates = new Engine(__DIR__ . '/../Views');

    }

    /**
     * Page de connexion (GET)
     */
    public function loginForm(): void
    {
        echo $this->templates->render('login', [
            'title' => 'Connexion'
        ]);
    }

    /**
     * Traitement du formulaire de connexion (POST)
     */
    public function loginProcess(array $post): void
    {
        $username = trim($post['username'] ?? '');
        $password = trim($post['password'] ?? '');

        if ($username === '' || $password === '') {
            toast("Veuillez entrer un identifiant et un mot de passe.", "error");
            $this->mainController->login();
            exit;
        }

        if (AuthService::login($username, $password)) {
            $this->logger->log('CONNEXION', 'LOGIN', true, "Connexion : $username");

            $this->mainController->index("Connexion réussie !");
            exit;
        }

        $this->logger->log('CONNEXION', 'LOGIN', false, "Failed Connexion : $username");
        toast("Identifiants incorrects.", "error");

        $this->mainController->login();
        exit;
    }

    /**
     * Déconnexion (GET)
     */
    public function logout(): void
    {
        AuthService::logout();

        $this->mainController->index("Vous êtes déconnecté");
        exit;
    }
}
