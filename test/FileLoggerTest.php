<?php

declare(strict_types=1);

namespace Test;

use App\Logs\FileLogger;
use App\Logs\LoggerInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class FileLoggerTest
 *
 * @package Test
 */
class FileLoggerTest extends TestCase
{

    private $logger;

    private $rootPathDir;

    public function setUp(): void
    {
        $this->rootPathDir = __DIR__ . '/../../logs/';

        if (!file_exists($this->rootPathDir)) {
            mkdir($this->rootPathDir, 0777, true);
        }
        $this->logger = new FileLogger();
    }

    /**
     * @param $level
     * @param $message
     * @param array $context
     */
    public function testLog($level, $message, array $context = [])
    {

        $fileName = date("Y_m_d_H") . ".log";
        $this->logger->log($level, $message);
        $log = file_get_contents($fileName);
        $this->assertEquals(
            '[' . date('d.m.Y H:i:s') .
            '] Level: \'' . $level . '\'. Message: \'' .
            $message . '\'' . PHP_EOL,
            $log
        );
    }

    /**
     * @return array
     */
    public function provider()
    {
        return [
            [FileLogger::INFO, 'info message'],
            [FileLogger::ERROR, 'error message'],
            [FileLogger::DEBUG, 'debug message'],
            [FileLogger::WARNING, 'warning message'],
            [FileLogger::NOTICE, 'notice message'],
        ];
    }
}
