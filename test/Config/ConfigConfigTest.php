<?php

declare(strict_types=1);

namespace Mos\Config;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the configuration file bootstrap.php.
 */
class ConfigConfigTest extends TestCase
{
    private $configFile = INSTALL_PATH . "/config/config.php";

    /**
     * Require the config file.
     */
    public function testRequireConfigFile()
    {
        $exp = 1;
        $res = require $this->configFile;
        $this->assertEquals($exp, $res);
    }
}
