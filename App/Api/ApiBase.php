<?php

namespace App\Api;

abstract class ApiBase
{
	public $apiName = ''; //forms

	protected $method = ''; //GET|POST|PUT|DELETE

	public $requestUri = [];
	public $requestParams = [];

	protected $action = '';


	public function __construct()
	{
		header("Access-Control-Allow-Orgin: *");
		header("Access-Control-Allow-Methods: *");
		header("Content-Type: application/json");

		//Array of GET parameters separated by a slash
		$this->requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
		$this->requestParams = $_REQUEST;

		//Defining the query method
		$this->method = $_SERVER['REQUEST_METHOD'];
		if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
			if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
				$this->method = 'DELETE';
			} else {
				if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
					$this->method = 'PUT';
				} else {
					throw new Exception("Unexpected Header");
				}
			}
		}
	}

	public function run()
	{

		if (array_shift($this->requestUri) !== 'api' || array_shift($this->requestUri) !== $this->apiName) {
			throw new RuntimeException('API Not Found', 404);
		}
		//Defining the action to be processed
		$this->action = $this->getAction();

		//If the method (action) is defined in the child class API
		if (method_exists($this, $this->action)) {
			return $this->{$this->action}();
		} else {
			throw new RuntimeException('Invalid Method', 405);
		}
	}

	protected function response($data, $status = 500)
	{
		header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
		return json_encode($data);
	}

	private function requestStatus($code)
	{
		$status = array(
			200 => 'OK',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			500 => 'Internal Server Error',
		);
		return ($status[$code]) ? $status[$code] : $status[500];
	}

	protected function getAction()
	{
		$method = $this->method;
		switch ($method) {
			case 'GET':
				return 'index';
				break;
			case 'POST':
				return 'create';
				break;
			case 'PUT':
				return 'update';
				break;
			case 'DELETE':
				return 'delete';
				break;
			default:
				return null;
		}
	}

	abstract protected function index();

	abstract protected function create();

	abstract protected function update();

	abstract protected function delete();
}