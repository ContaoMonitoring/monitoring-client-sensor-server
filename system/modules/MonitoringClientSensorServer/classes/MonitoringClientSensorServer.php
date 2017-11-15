<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2017 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2017-2017
 * @author     Cliff Parnitzky
 * @package    MonitoringClientSensorServer
 * @license    LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Monitoring;

/**
 * Class MonitoringClientSensorServer
 *
 * Special sensor for the MonitoringClient to read the server data.
 * @copyright  Cliff Parnitzky 2017-2017
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class MonitoringClientSensorServer extends \Backend
{
  /**
   * Constructor
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Get the data from the client.
   */
  public function readData($arrData)
  {
    // PHP
    $arrIniGetAll = ini_get_all();
    $arrData['php.max_execution_time'] = $arrIniGetAll['max_execution_time']['local_value'];
    $arrData['php.memory_limit'] = $arrIniGetAll['memory_limit']['local_value'];
    $arrData['php.version'] = phpversion();
    // Server
    $arrData['server.os'] = php_uname();
    $arrData['server.software'] = $_SERVER['SERVER_SOFTWARE'];
    // MySQL (need hacky reflection here)
    $objDatabase = \Database::getInstance();
    $resConnection = new \ReflectionProperty($objDatabase,'resConnection');
    $resConnection->setAccessible(true);
    $arrData['mysql.version'] = mysqli_get_server_info($resConnection->getValue($objDatabase));
    $resConnection->setAccessible(false);
    
    return $arrData;
  }
}

?>