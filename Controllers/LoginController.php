<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Logger;
use Services\AuthService;
use function Helpers\toast;

/**
 * Controller to handle user login and logout operations.
 */
class LoginController
{
    private Engine $templates;
    private Logger $logger;
    private MainController $mainController;

    /**
     * Constructor.
     *
     * @param MainController $mainController Main controller for redirections.
     */
    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
        $this->logger = new Logger();
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    /**
     * Display the login form (GET request).
     */
    public function loginForm(): void
    {
        echo $this->templates->render('login', [
            'title' => 'Login'
        ]);
    }

    /**
     * Process the login form (POST request).
     *
     * @param array $post Form data containing 'username' and 'password'.
     */
    public function loginProcess(array $post): void
    {
        $username = trim($post['username'] ?? '');
        $password = trim($post['password'] ?? '');

        if ($username === '' || $password === '') {
            toast("Please enter a username and password.", "error");
            $this->mainController->login();
            exit;
        }

        if (AuthService::login($username, $password)) {
            $this->logger->log('CONNEXION', 'LOGIN', true, "Login successful: $username");
            $this->mainController->index("Login successful!");
            exit;
        }

        $this->logger->log('CONNEXION', 'LOGIN', false, "Failed login attempt: $username");
        toast("Incorrect credentials.", "error");
        $this->mainController->login();
        exit;
    }

    /**
     * Log out the current user (GET request).
     */
    public function logout(): void
    {
        AuthService::logout();
        $this->mainController->index("You have been logged out.");
        exit;
    }
}
