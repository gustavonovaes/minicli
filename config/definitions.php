<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Minicli\Interfaces\PrinterInterface;

use Minicli\Printers\Cli;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

$c = [];

$c[PrinterInterface::class] = DI\create(Cli::class);

$c[LoggerInterface::class] = function (ContainerInterface $c) {
  $settings = $c->get('logger');
  $level = $settings['level'] ?? Logger::ERROR;
  $logFile = $settings['file'];
  $maxFiles = $settings['maxFiles'] ?? 7;

  $logger = new Logger($settings['name']);
  $logger->pushHandler(
    new RotatingFileHandler($logFile, $maxFiles, $level, true, 0775)
  );

  return $logger;
};

return $c;
