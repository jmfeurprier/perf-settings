<?php

namespace perf\Settings;

/**
 *
 */
class SettingsTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @expectedException \InvalidArgumentException
     */
    public function testHasWithNonStringKey()
    {
        $key = 123;

        $settings = new Settings();

        $settings->has($key);
    }

    /**
     *
     */
    public function testHasWithNotExistingKey()
    {
        $key = 'foo';

        $settings = new Settings();

        $this->assertFalse($settings->has($key));
    }

    /**
     *
     */
    public function testHasWithExistingKeyFromConstructor()
    {
        $key    = 'foo';
        $values = array(
            $key => 'bar',
        );

        $settings = new Settings($values);

        $this->assertTrue($settings->has($key));
    }

    /**
     *
     */
    public function testHasWithExistingKeyFromSet()
    {
        $key   = 'foo';
        $value = 'bar';

        $settings = new Settings();
        $settings->set($key, $value);

        $this->assertTrue($settings->has($key));
    }

    /**
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetWithNonStringKey()
    {
        $key   = 123;
        $value = 'bar';

        $settings = new Settings();

        $settings->set($key, $value);
    }

    /**
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetWithNonStringValue()
    {
        $key   = 'foo';
        $value = 123;

        $settings = new Settings();

        $settings->set($key, $value);
    }

    /**
     *
     * @expectedException \InvalidArgumentException
     */
    public function testGetWithNonStringValue()
    {
        $key = 123;

        $settings = new Settings();

        $settings->get($key);
    }

    /**
     *
     * @expectedException \DomainException
     */
    public function testGetWithNotExistingKey()
    {
        $key = 'foo';

        $settings = new Settings();

        $settings->get($key);
    }

    /**
     *
     */
    public function testGetWithExistingKey()
    {
        $key   = 'foo';
        $value = 'bar';

        $settings = new Settings();
        $settings->set($key, $value);

        $this->assertSame($value, $settings->get($key));
    }
}
