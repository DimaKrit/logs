<?php

namespace App\Controllers;

use App\Logs\FileLogger;

class IndexController extends Controller
{
	/**
	 * @return string
	 */
	public function index()
    {

    	$this->logger->log(FileLogger::INFO, 'Return index controller'); //example

        return 'I am action index';
    }
}
