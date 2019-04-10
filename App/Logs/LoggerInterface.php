<?php

namespace App\Logs;

interface LoggerInterface
{

	public function log($level, $message, array $context = []);

}