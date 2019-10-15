<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '0');

set_error_handler(function ($severity, $message, $file, $line) {
  if (error_reporting() & $severity) {
    throw new \ErrorException($message, 0, $severity, $file, $line);
  }
});

// Timezone
date_default_timezone_set('America/Recife');

$settings = [
  'logger' => [
    'name' => 'Minicli',
    'file' => __DIR__ . '/../log/app.log',
  ],

  'commands' => [
    'help' => \Minicli\Commands\Help::class,
    'hello' => \Minicli\Commands\Hello::class,
  ]
];

return $settings;
