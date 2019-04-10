<?php

namespace App\Controllers;

use App\Logs\FileLogger;

class IndexController
{

	private $loger;

	public function __construct()
	{
		$this->loger = new FileLogger();
	}

	public function index()
    {

    	$this->loger->log(FileLogger::INFO, 'Return index controller'); //example

        return 'I am action index';
    }
}
