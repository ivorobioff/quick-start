<?php
namespace ImmediateSolutions\Support\Session;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface SessionInterface
{
    /**
     * @param string $key
     * @param mixed $value
     */
    public function write($key, $value);

    /**
     * @param string $key
     * @return mixed
     */
    public function read($key);

    /**
     * @param string $key
     * @return bool
     */
    public function exists($key);
}