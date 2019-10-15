<?php

namespace Minicli\Interfaces;

interface PrinterInterface
{
  public function newLine(): void;

  public function out(string $text): void;

  public function display(string $text): void;
}
