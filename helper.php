<?php
/**
 * @package JowClock for Joomla 3.0
 * @version 1.0
 * @author Troy T. Hall (http://jowwow.me)
 * @copyright (C) 2013 JowWow
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined( '_JEXEC' ) or die( 'Restricted access' );

class modJowClockHelper
{   
    public static function getTime( $params )
    {
		$timezone=$params->get('timezone');
		date_default_timezone_set($timezone); 
		//$time=date("y,m,d,H,i,s");
		$time=date("F d, Y H:i:s");
        return $time;
    }
	
	public static function getOutputTimezone( $params )
    {
		$timezoneOut=$params->get('timezone');
		$timezoneFormat=$params->get('timezone-format');
		if($timezoneFormat=="full"){
			$timezoneOut = str_replace("Indian/","Indian Ocean, ",$timezoneOut);
			$timezoneOut = str_replace("Pacific/","Pacific Ocean, ",$timezoneOut);
			$timezoneOut = str_replace("Atlantic/","Atlantic Ocean, ",$timezoneOut);
			$timezoneOut = str_replace("/",", ",$timezoneOut);
		}
		elseif($timezoneFormat=="city"){
			$timezoneOut = str_replace("Africa/","",$timezoneOut);
			$timezoneOut = str_replace("America/","",$timezoneOut);
				$timezoneOut = str_replace("Argentina/","",$timezoneOut);
				$timezoneOut = str_replace("Indiana/","",$timezoneOut);
				$timezoneOut = str_replace("Kentucky/","",$timezoneOut);
				$timezoneOut = str_replace("North_Dakota/","",$timezoneOut);
			$timezoneOut = str_replace("Antarctica/","",$timezoneOut);
			$timezoneOut = str_replace("Arctic/","",$timezoneOut);
			$timezoneOut = str_replace("Asia/","",$timezoneOut);
			$timezoneOut = str_replace("Atlantic/","",$timezoneOut);
			$timezoneOut = str_replace("Australia/","",$timezoneOut);
			$timezoneOut = str_replace("Europe/","",$timezoneOut);
			$timezoneOut = str_replace("Indian/","",$timezoneOut);
			$timezoneOut = str_replace("Pacific/","",$timezoneOut);
		}
		elseif($timezoneFormat=="custom"){
			$timezoneOut=$params->get('customTimezone');
		}
		$timezoneOut = str_replace("_"," ",$timezoneOut);
        return $timezoneOut;
    }
}