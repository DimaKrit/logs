<?php

namespace App\Logs;

class FileLogger implements LoggerInterface
{

	const ERROR = 'Error';
	const WARNING = 'Warning';
	const NOTICE = 'Notice';
	const INFO = 'Info';
	const DEBUG = 'Debug';

	private $rootPathDir =__DIR__ . '/../../logs/';

	protected $template = "[{date}] Level: `{level}` Message: `{message}` Context: `{context}`";

	public function log($level, $message, array $context = [])
	{
		$fileName = date("Y_m_d_H") . ".log";

		file_put_contents($this->rootPathDir . $fileName, trim(strtr($this->template, [
				'{date}' => $this->getDate(),
				'{level}' => $level,
				'{message}' => $message,
				'{context}' => $this->contextStringify($context),
			])) . PHP_EOL, FILE_APPEND);
	}

	protected function contextStringify(array $context = [])
	{
		return !empty($context) ? json_encode($context) : null;
	}

	protected function getDate()
	{
		return date("Y-m-d H:i:s");
	}

}

