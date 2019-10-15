<?php

namespace Minicli\Printers;

use Minicli\Interfaces\PrinterInterface;

/**
 * This is a printer for the command line
 */
class Cli implements PrinterInterface
{
  /**
   * Display a formated text
   * 
   * @param string $text
   *
   * @return void
   */
  public function display(string $text): void
  {
    $this->newLine();
    $this->out($text);
    $this->newLine();
    $this->newLine();
  }

  /**
   * Print a new line 
   *
   * @return void
   */
  public function newLine(): void
  {
    $this->out("\n");
  }

  /**
   * Shows a text
   * @param string $text
   *
   * @return void
   */
  public function out(string $text): void
  {
    echo $text;
  }
}
