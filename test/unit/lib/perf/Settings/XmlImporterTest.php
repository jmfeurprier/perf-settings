<?php

namespace perf\Settings;

/**
 *
 */
class XmlImporterTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    protected function setUp()
    {
        $this->importer = new XmlImporter();

        $this->source = $this->getMock('\\perf\\Source\\Source');
    }

    /**
     *
     * @expectedException \RuntimeException
     */
    public function testImportWithEmptyXml()
    {
        $xml = '';

        $this->source->expects($this->once())->method('getContent')->willReturn($xml);

        $this->importer->import($this->source);
    }

    /**
     *
     */
    public function testImportWithEmptyRootNode()
    {
        $xml = '<test/>';

        $this->source->expects($this->once())->method('getContent')->willReturn($xml);

        $result = $this->importer->import($this->source);

        $this->assertInstanceOf(__NAMESPACE__ . '\\Settings', $result);
        $this->assertCount(0, $result->getAll());
    }

    /**
     *
     */
    public function testImportWithOneItem()
    {
        $xml = '<test><foo>bar</foo></test>';

        $this->source->expects($this->once())->method('getContent')->willReturn($xml);

        $result = $this->importer->import($this->source);

        $this->assertInstanceOf(__NAMESPACE__ . '\\Settings', $result);
        $this->assertCount(1, $result->getAll());
        $this->assertSame('bar', $result->get('foo'));
    }
}
