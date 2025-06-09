<?php
/**
 * @package     Bears Clock
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright   Copyright (c) 2025 N6REJ
 * @license     GNU General Public License version 3 or later; see LICENSE
 * @since       2025.6.8
 *
 * @var Joomla\Registry\Registry $params Module parameters (provided by Joomla)
 */

declare(strict_types=1);

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Uri\Uri;

// Get the application and document objects
$app      = Factory::getApplication();
$document = $app->getDocument();

// Add the module CSS
$document->addStyleSheet(Uri::base() . 'modules/mod_bearsclock/css/mod_bearsclock.css');

// Include the helper only once
require_once __DIR__ . '/helper.php';

use BearsClock\Module\BearsClock\Site\Helper\BearsClockHelper;

// Get parameters
$timezone     = $params->get('timezone');
$time         = BearsClockHelper::getTime($params);
$format       = $params->get('format');
$seconds      = $params->get('seconds');
$date         = $params->get('date');
$leadingZeros = $params->get('leadingZeros');
$outTimezone  = BearsClockHelper::getOutputTimezone($params);

// Render the layout
require ModuleHelper::getLayoutPath('mod_bearsclock');
