<?php

namespace Helpers;

class Toast {

    private static function init() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function success($message) {
        self::add($message, 'success');
    }

    public static function error($message) {
        self::add($message, 'error');
    }

    // On ajoute [] pour créer un tableau de toasts
    private static function add($message, $type) {
        self::init();
        $_SESSION['toasts'][] = [
            'message' => $message,
            'type' => $type
        ];
    }

    public static function render() {
        self::init();

        // S'il y a des messages
        if (isset($_SESSION['toasts']) && !empty($_SESSION['toasts'])) {

            echo '<div class="toast-container">';

            // On boucle sur tous les messages
            foreach ($_SESSION['toasts'] as $toast) {
                echo '<div class="toast toast-' . htmlspecialchars($toast['type']) . '">';
                echo      htmlspecialchars($toast['message']);
                echo '</div>';
            }

            echo '</div>';

            // LE VIDAGE : On supprime tout le tableau d'un coup après l'affichage
            unset($_SESSION['toasts']);
        }
    }
}
/**
 * Fonction raccourcie pour créer un toast.
 *
 * @param string $message Le texte à afficher
 * @param string $type Le type de message ('success' par défaut, ou 'error')
 */
function toast($message, $type = 'success') {
    if ($type === 'error') {
        Toast::error($message);
    } else {
        Toast::success($message);
    }
}
?>


