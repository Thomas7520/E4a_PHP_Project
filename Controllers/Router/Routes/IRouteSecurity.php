<?php

namespace Routes;

interface IRouteSecurity
{
    public function isRouteProtected(): bool;
    public function protectRoute(): void;
}
