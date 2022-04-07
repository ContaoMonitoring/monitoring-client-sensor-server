<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2022 Leo Feyer
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
 * @copyright  Cliff Parnitzky 2017-2022
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
 * @copyright  Cliff Parnitzky 2017-2022
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
    $arrData['php.max_execution_time'] = ini_get('max_execution_time');
    $arrData['php.memory_limit'] = ini_get('memory_limit');
    $arrData['php.file_uploads'] = ini_get('file_uploads');
    $arrData['php.upload_max_filesize'] = ini_get('upload_max_filesize');
    $arrData['php.post_max_size'] = ini_get('post_max_size');
    $arrData['php.max_input_vars'] = ini_get('max_input_vars');
    $arrData['php.opcache.enable'] = ini_get('opcache.enable');
    $arrData['php.opcache.enable_cli'] = ini_get('opcache.enable_cli');
    $arrData['php.opcache.max_accelerated_files'] = ini_get('opcache.max_accelerated_files');
    $arrData['php.safe_mode'] = ini_get('safe_mode');
    $arrData['php.open_basedir'] = ini_get('open_basedir');
    $arrData['php.version'] = phpversion();
    // Server
    $arrData['server.os'] = php_uname();
    $arrData['server.software'] = $_SERVER['SERVER_SOFTWARE']; 
    // Database
    $version = \Database::getInstance()->prepare("SELECT @@version as version")->execute()->version;
    $arrData['database.version'] = strpos($version, "-") ? substr($version, 0, strpos($version, "-")) : $version;
    $arrData['database.platform'] = basename(str_replace('\\', '/', get_class(\System::getContainer()->get('database_connection')->getDatabasePlatform())));
    // Keep for backwards compatibility
    $arrData['mysql.version'] = $arrData['database.version'];
    
    return $arrData;
  }
}

?>