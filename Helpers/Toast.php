<?php

namespace Helpers;

/**
 * Simple toast notification handler using PHP sessions.
 */
class Toast {

    /**
     * Initialize session if not already started.
     */
    private static function init(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Add a success toast message.
     *
     * @param string $message The message to display.
     */
    public static function success(string $message): void
    {
        self::add($message, 'success');
    }

    /**
     * Add an error toast message.
     *
     * @param string $message The message to display.
     */
    public static function error(string $message): void
    {
        self::add($message, 'error');
    }

    /**
     * Add a toast message to the session.
     *
     * @param string $message The message content.
     * @param string $type The type of toast ('success' or 'error').
     */
    private static function add(string $message, string $type): void
    {
        self::init();
        $_SESSION['toasts'][] = [
            'message' => $message,
            'type' => $type
        ];
    }

    /**
     * Render all toast messages and clear them from the session.
     */
    public static function render(): void
    {
        self::init();

        if (isset($_SESSION['toasts']) && !empty($_SESSION['toasts'])) {
            echo '<div class="toast-container">';

            foreach ($_SESSION['toasts'] as $toast) {
                echo '<div class="toast toast-' . htmlspecialchars($toast['type']) . '">';
                echo      htmlspecialchars($toast['message']);
                echo '</div>';
            }

            echo '</div>';

            // Clear all toasts after rendering
            unset($_SESSION['toasts']);
        }
    }
}

/**
 * Shortcut function to create a toast message.
 *
 * @param string $message The message to display.
 * @param string $type The type of toast ('success' by default, or 'error').
 */
function toast(string $message, string $type = 'success'): void
{
    if ($type === 'error') {
        Toast::error($message);
    } else {
        Toast::success($message);
    }
}
