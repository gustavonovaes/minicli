<?php

declare(strict_types=1);

namespace Minicli;

use Minicli\Interfaces\CommandInterface;
use Minicli\Interfaces\PrinterInterface;
use Psr\Container\ContainerInterface;

/**
 * This is an entry point off application.
 */
class App
{
  /** @var ContainerInterface  */
  protected $container;

  /**   
   * Create a new instance of App.
   * 
   * @param ContainerInterface $container
   */
  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

  /**
   * Get a printer from container
   *
   * @return PrinterInterface
   */
  public function getPrinter(): PrinterInterface
  {
    return $this->container->get(PrinterInterface::class);
  }

  /**
   * Get a command from container
   * 
   * @param string $name Name of command
   *
   * @return CommandInterface|null
   */
  public function getCommand(string $name): ?CommandInterface
  {
    $commands = $this->container->get('commands');

    return isset($commands[$name])
      ? new $commands[$name]($this->container)
      : null;
  }

  /**
   * Run a command
   * 
   * @param array $argv Arguments pass by command line
   *
   * @return void
   */
  public function run(array $argv = [])
  {
    if (!isset($argv[1])) {
      $message = "USAGE: ./miniapp <command> <...args>";
      return $this->getPrinter()->display($message);
    }

    $commandName = $argv[1];

    $command = $this->getCommand($commandName);
    if (!$command) {
      return $this->getPrinter()
        ->display("ERROR: Command \"{$commandName}\" not found.");
    }

    $command->run($argv);
  }
}
