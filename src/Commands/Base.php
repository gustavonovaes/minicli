<?php

declare(strict_types=1);

namespace Minicli\Commands;

use Minicli\Interfaces\CommandInterface;
use Minicli\Interfaces\PrinterInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * This is a base class for commands.
 * 
 * It implements common methods for commands.
 */
abstract class Base implements CommandInterface
{
  /** @var ContainerInterface $container */
  protected $container;

  /**
   * Create a new instance of command.
   * 
   * @param ContainerInterface $container
   */
  public function __construct(
    ContainerInterface $container
  ) {
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
   * Get a logger from container
   *
   * @return LoggerInterface
   */
  public function getLogger(): LoggerInterface
  {
    return $this->container->get(LoggerInterface::class);
  }
}
