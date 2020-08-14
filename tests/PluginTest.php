<?php

namespace afLoginPopUp\Tests;

use afLoginPopUp\afLoginPopUp as Plugin;
use Shopware\Components\Test\Plugin\TestCase;

class PluginTest extends TestCase
{
    protected static $ensureLoadedPlugins = [
        'afLoginPopUp' => []
    ];

    public function testCanCreateInstance()
    {
        /** @var Plugin $plugin */
        $plugin = Shopware()->Container()->get('kernel')->getPlugins()['afLoginPopUp'];

        $this->assertInstanceOf(Plugin::class, $plugin);
    }
}
