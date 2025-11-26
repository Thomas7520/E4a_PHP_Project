<?php

namespace Routes;

use Services\AuthService;
use Exception;

abstract class ProtectedRoute extends Route implements IRouteSecurity
{
    public function isRouteProtected(): bool
    {
        return true;
    }

    public function protectRoute(): void
    {
        if (!AuthService::isLogged()) {
            throw new Exception("NOT_LOGGED");
        }
    }
}
