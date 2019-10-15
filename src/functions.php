<?php

declare(strict_types=1);

function dd(array ...$args): void
{
  var_dump($args);
  exit;
}

/**
 * Semantic implementation of array_map
 * @param array $arr
 * @param Closure $fn
 *
 * @return array
 */
function arrayMap(array $arr, Closure $fn): array
{
  return array_map($fn, $arr);
}

/**
 * Performa a shallow merge between items of $arr
 * @param array $arr
 *
 * @return array
 */
function arrayFlat(array $arr): array
{
  return array_reduce($arr, 'array_merge', []);
}

/**
 * Create a array with the $keys and fill each key with $value
 * @param strings $keys
 * @param mixed $value
 *
 * @return void
 */
function arrayCombineFill(array $keys, mixed $value): array
{
  return array_combine(
    $keys,
    array_fill(0, count($keys), $value)
  );
}
