<?php

namespace perf\Settings;

use perf\Source\Source;

/**
 *
 *
 */
class XmlImporter implements Importer
{

    /**
     *
     * Temporary property.
     *
     * @var {string:string}
     */
    private $values = array();

    /**
     *
     *
     * @param Source $source
     * @return Settings
     * @throws \RuntimeException
     */
    public function import(Source $source)
    {
        $this->values = array();

        $sxe = simplexml_load_string($source->getContent());

        if (false === $sxe) {
            throw new \RuntimeException('Failed to import settings from XML source.');
        }

        $this->parseValues($sxe);

        return new Settings($this->values);
    }

    /**
     *
     *
     * @param \SimpleXMLElement $sxe
     * @param string[] $pathTokens
     * @return {string:string}
     */
    private function parseValues(\SimpleXMLElement $sxe, $pathTokens = array())
    {
        $children = $sxe->children();

        if (count($children) > 0) {
            foreach ($children as $sxeChild) {
                $childPathTokens   = $pathTokens;
                $childPathTokens[] = $sxeChild->getName();

                $this->parseValues($sxeChild, $childPathTokens);
            }
        } else {
            $settingKey = join('.', $pathTokens);

            $this->values[$settingKey] = (string) $sxe;
        }
    }
}
