<?php

namespace App\Tests\Commands;

use Minicli\Printers\Cli;
use PHPUnit\Framework\TestCase;

class CliTest extends TestCase
{
  /** @var Cli $cli */
  protected $cli;

  protected function setUp(): void
  {
    $this->cli = new Cli();
  }

  public function testOut()
  {
    $str = "foo";
    $this->expectOutputString($str);
    $this->cli->out($str);
  }

  public function testNewLine()
  {
    $this->expectOutputString("\n");
    $this->cli->newLine();
  }

  public function testDisplay()
  {
    $str = "foo";
    $this->expectOutputString("\n{$str}\n\n");
    $this->cli->display($str);
  }
}
