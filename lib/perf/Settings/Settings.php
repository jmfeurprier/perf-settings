<?php

namespace perf\Settings;

/**
 *
 *
 */
class Settings
{

    /**
     *
     *
     * @var Settings
     */
    private $values;

    /**
     *
     *
     * @return Settings
     */
    public static function createFromSimpleXMLElement(\SimpleXMLElement $sxe)
    {
        $values = self::parseValues($sxe);

        return new self($values);
    }

    /**
     *
     *
     */
    private static function parseValues(\SimpleXMLElement $sxe, $pathTokens = array())
    {
        $values = array();

        $children = $sxe->children();

        if (count($children) > 0) {
            foreach ($children as $sxeChild) {
                $childPathTokens   = $pathTokens;
                $childPathTokens[] = $sxeChild->getName();

                foreach (self::parseValues($sxeChild, $childPathTokens) as $key => $value) {
                    $values[$key] = $value;
                }
            }
        } else {
            $settingKey = join('.', $pathTokens);

            $values[$settingKey] = (string) $sxe;
        }

        return $values;
    }

    /**
     * Constructor.
     *
     * @param {string:string} $values
     * @return void
     */
    private function __construct(array $values)
    {
        $this->values = $values;
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
