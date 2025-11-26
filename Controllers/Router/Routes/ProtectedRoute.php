<?php

namespace Routes;

use Services\AuthService;
use Exception;

/**
 * Abstract route class that enforces authentication.
 *
 * All routes extending this class are protected and require the user to be logged in.
 */
abstract class ProtectedRoute extends Route implements IRouteSecurity
{
    /**
     * Indicates that this route is protected.
     *
     * @return bool Always returns true.
     */
    public function isRouteProtected(): bool
    {
        return true;
    }

    /**
     * Enforces route protection by checking if the user is logged in.
     *
     * @throws Exception if the user is not logged in.
     */
    public function protectRoute(): void
    {
        if (!AuthService::isLogged()) {
            throw new Exception("NOT_LOGGED");
        }
    }
}
