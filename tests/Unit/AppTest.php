<?php

namespace App\Tests;

use App\Tests\Base\BaseTestCase;
use Minicli\App;
use Minicli\Commands\Base;
use Minicli\Interfaces\PrinterInterface;
use Minicli\Printers\Cli;

class CommandExample extends Base
{
  public function run(array $args): void
  {
    $this->getPrinter()->display('42');
  }
}

class AppTest extends BaseTestCase
{
  public function testShowUsageIfNotPassCommands()
  {
    $this->expectOutputRegex("/USAGE: /");

    $mockContainer = $this->factoryMockContainer([
      'commands' => [],
      PrinterInterface::class => new Cli(),
    ]);

    $app = new App($mockContainer);
    $app->run([]);
  }

  public function testShowErrorIfNotPassCommands()
  {
    $command = 'notExist';

    $this->expectOutputRegex("/ERROR: Command \"$command\" not found\./");

    $mockContainer = $this->factoryMockContainer([
      'commands' => [],
      PrinterInterface::class => new Cli(),
    ]);

    $app = new App($mockContainer);
    $app->run(['', $command]);
  }

  public function testRunACommand()
  {
    $commandName = 'test';
    $argv = ['', $commandName];

    $mockContainer = $this->factoryMockContainer([
      'commands' => [
        $commandName => CommandExample::class,
      ],
      PrinterInterface::class => new Cli(),
    ]);

    $this->expectOutputRegex("/42/");

    $app = new App($mockContainer);
    $app->run($argv);
  }
}
