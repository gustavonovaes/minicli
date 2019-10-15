<?php

namespace Minicli\Interfaces;

interface CommandInterface
{
  public function run(array $args): void;
}
