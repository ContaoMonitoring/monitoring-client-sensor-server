<?php

declare(strict_types=1);

/*
 * @license LGPL-3.0-or-later
 */

namespace ContaoMonitoring\ContaoMonitoringClientSensorServer\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use ContaoMonitoring\ContaoMonitoringClientSensorServer\ContaoMonitoringClientSensorServerBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoMonitoringClientSensorServerBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
