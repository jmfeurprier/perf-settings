<?php

namespace perf\Settings;

use perf\Source\Source;

/**
 *
 *
 */
interface Importer
{

    /**
     *
     *
     * @param Source $source
     * @return Settings
     */
    public function import(Source $source);
}
