<?php

namespace perf\Settings;

/**
 *
 *
 */
class Settings
{

    /**
     * Settings values.
     *
     * @var {string:string}
     */
    private $values = array();

    /**
     * Constructor.
     *
     * @param {string:string} $values
     * @return void
     * @throws \InvalidArgumentException
     */
    public function __construct(array $values = array())
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     *
     *
     * @param string $key
     * @param string $value
     * @return void
     * @throws \InvalidArgumentException
     */
    public function set($key, $value)
    {
        if (!is_string($key)) {
            throw new \InvalidArgumentException("Invalid setting key.");
        }

        if (!is_string($value)) {
            throw new \InvalidArgumentException("Invalid setting key.");
        }

        return $this->values[$key] = $value;
    }

    /**
     *
     *
     * @param string $key
     * @return mixed
     * @throws \InvalidArgumentException
     * @throws \DomainException
     */
    public function get($key)
    {
        if (!is_string($key)) {
            throw new \InvalidArgumentException("Invalid setting key.");
        }

        if (array_key_exists($key, $this->values)) {
            return $this->values[$key];
        }

        throw new \DomainException("Setting with key '{$key}' not found.");
    }
}
