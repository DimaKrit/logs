<?php
declare(strict_types=1);

namespace Test;

use App\Controllers\IndexController;
use PHPUnit\Framework\TestCase;

/**
 * Class IndexControllerTest
 *
 * @package Test
 */
class IndexControllerTest extends TestCase
{
    public function testIndex(): void
    {
        $class = new IndexController();
        $this->expectOutputString('Action index');
        $class->index();
    }
}