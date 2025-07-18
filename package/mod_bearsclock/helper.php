<?php
/**
 * @package     Bears Clock
 * @author      N6REJ
 * @email       troy@hallhome.us
 * @website     https://www.hallhome.us
 * @copyright   Copyright (c) 2025 N6REJ
 * @license     GNU General Public License version 3 or later; see LICENSE
 * @since       2025.6.8
 */

declare(strict_types=1);

namespace BearsClock\Module\BearsClock\Site\Helper;

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

use Joomla\Registry\Registry;

final class BearsClockHelper
{
    public static function getTime(Registry $params): string
    {
        $timezone = $params->get('timezone');
        date_default_timezone_set($timezone);
        return date('F d, Y H:i:s');
    }

    public static function getOutputTimezone(Registry $params): string
    {
        $timezoneOut = $params->get('timezone', 'UTC');
        $timezoneFormat = $params->get('timezone-format', 'full');

        if ($timezoneFormat === 'full') {
            $timezoneOut = str_replace('Indian/', 'Indian Ocean, ', $timezoneOut);
            $timezoneOut = str_replace('Pacific/', 'Pacific Ocean, ', $timezoneOut);
            $timezoneOut = str_replace('Atlantic/', 'Atlantic Ocean, ', $timezoneOut);
            $timezoneOut = str_replace('/', ', ', $timezoneOut);
        } elseif ($timezoneFormat === 'city') {
            // Strip everything before and including the last '/'
            if (strpos($timezoneOut, '/') !== false) {
                $timezoneOut = substr($timezoneOut, strrpos($timezoneOut, '/') + 1);
            }
        }
        $timezoneOut = str_replace('_', ' ', $timezoneOut);
        return $timezoneOut;
    }
}
