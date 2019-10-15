<?php

$settings = require __DIR__ . "/settings.php";
$definitions = require __DIR__ . "/definitions.php";

$builder = new DI\ContainerBuilder();
$builder->addDefinitions(array_merge($settings, $definitions));
$builder->useAutowiring(false);

$container = $builder->build();

return $container;
