<?php

namespace App\Tests\Base;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class BaseTestCase extends TestCase
{
  public function factoryMockContainer(array $results)
  {
    $logicalOr = array_map(function ($get) {
      return $this->equalTo($get);
    }, array_keys($results));

    $with = $this->logicalOr(...$logicalOr);

    $will = $this->returnCallback(function ($arg) use ($results) {
      return $results[$arg];
    });

    $mockContainer = $this->getMockBuilder(ContainerInterface::class)
      ->disableOriginalConstructor()
      ->setMethods(['__construct', 'get', 'has'])
      ->getMock();

    $mockContainer->method('get')
      ->with($with)
      ->will($will);

    return $mockContainer;
  }
}
