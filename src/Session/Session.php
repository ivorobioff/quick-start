<?php
namespace ImmediateSolutions\Support\Session;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Session implements SessionInterface
{
    /**
     * @param string $key
     * @param mixed $value
     */
    public function write($key, $value)
    {
        array_set($_SESSION, $key, $value);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function read($key)
    {
        return array_get($_SESSION, $key);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function exists($key)
    {
        return array_has($_SESSION, $key);
    }

    /**
     * @param string $key
     */
    public function delete($key)
    {
        array_forget($_SESSION, $key);
    }
}