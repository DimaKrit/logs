<?php

namespace App;

class Config
{
    public static function get($section = null)
    {
        $config = include __DIR__ . '/../config/config.php';

        if (isset($section)) {
            return $config[$section] ?? null;
        }
        return $config;
    }
}
