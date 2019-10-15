<?php

declare(strict_types=1);

namespace Minicli\Commands;

/**
 * This is a command 
 */
class Hello extends Base
{
  /**
   * Display and log a greeting.
   * 
   * @param string[] $args Arguments pass by command line
   *
   * @return void
   */
  public function run(array $args): void
  {
    $name = $args[2] ?? "World";
    $out = "Hello {$name}!!!";

    $this->getPrinter()->display($out);
    $this->getLogger()->info($out);
  }
}
