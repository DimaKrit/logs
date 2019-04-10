<?php

namespace App\Http;

class Route implements RouteInterface
{
    private $class;
    private $action;

    public function __construct(string $class, string $action)
    {
        $this->class = $class;
        $this->action = $action;
    }

    public function getClass() : string
    {
        return $this->class;
    }

    public function getAction() : string
    {
        return $this->action;
    }
}
