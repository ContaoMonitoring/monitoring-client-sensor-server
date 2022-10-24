<?php

declare(strict_types=1);

/*
 * @license LGPL-3.0-or-later
 */

namespace ContaoMonitoring\ContaoMonitoringClientSensorServer;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoMonitoringClientSensorServerBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
