<?php

namespace App\Tests\Commands;

use App\Tests\Base\BaseTestCase;
use Minicli\Commands\Hello;
use Minicli\Interfaces\PrinterInterface;
use Psr\Log\LoggerInterface;

class HelloTest extends BaseTestCase
{
  public function testRun()
  {
    $name = "foo";
    $output = "Hello $name!!!";
    
    $mockPrinter = $this->getMockBuilder(PrinterInterface::class)
      ->disableOriginalConstructor()
      ->setMethods(['display', 'newLine', 'out'])
      ->getMock();

    $mockPrinter->expects($this->once())
      ->method('display')
      ->will($this->returnCallback(function ($arg) {
        echo $arg;
      }));

    $mockLogger = $this->getMockBuilder(LoggerInterface::class)
      ->disableOriginalConstructor()
      ->setMethods(['info', 'emergency', 'alert', 'critical', 'notice', 'warning', 'error', 'debug', 'log'])
      ->getMock();

    $mockLogger->expects($this->once())
      ->method('info')
      ->with($output);

    $mockContainer = $this->factoryMockContainer([
      PrinterInterface::class => $mockPrinter,
      LoggerInterface::class => $mockLogger,
    ]);

    $hello = new Hello($mockContainer);

    $this->expectOutputString($output);

    $hello->run(['', '', $name]);
  }
}
