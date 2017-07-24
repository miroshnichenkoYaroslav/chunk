<?php
/**
 * @param string $class
 * @param array  $attributes
 * @param int    $times
 *
 * @return mixed
 */
function create($class, array $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

/**
 * @param string $class
 * @param array  $attributes
 * @param int    $times
 *
 * @return mixed
 */
function make($class, array $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}
