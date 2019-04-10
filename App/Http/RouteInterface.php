<?php

namespace App\Http;

interface RouteInterface
{
    public function __construct(string $class, string $action);

    public function getClass() : string;

    public function getAction() : string;
}
