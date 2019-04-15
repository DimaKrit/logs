<?php

namespace App\Controllers;

use App\Logs\FileLogger;

/**
 * Class Controller
 * @package App\Controllers
 */
class Controller
{

	protected $logger;

	public function __construct()
	{
		$this->logger = new FileLogger();
	}
}