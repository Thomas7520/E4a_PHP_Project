<?php

namespace Config;

use Exception;

class Config {
    /**
     * Holds the configuration parameters.
     *
     * @var array|null
     */
    private static $param;

    /**
     * Retrieves a configuration value by name.
     *
     * @param string $name The name of the configuration parameter.
     * @param mixed $defaultValue The default value to return if the parameter does not exist.
     * @return mixed The configuration value or the default value if not found.
     */
    public static function get($name, $defaultValue = null) {
        if (isset(self::getParameter()[$name])) {
            $value = self::getParameter()[$name];
        } else {
            $value = $defaultValue;
        }
        return $value;
    }

    /**
     * Returns all configuration parameters.
     *
     * @return array The array of configuration parameters.
     */
    private static function getParameter(): array {
        // Lazy-load parameters if not already loaded
        if (self::$param === null) {
            // Example: Load configuration from a file
            self::$param = include __DIR__ . '/config.php';
        }
        return self::$param;
    }
}
