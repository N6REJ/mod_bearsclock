<?php
/**
 * @package JowClock for Joomla 3.0
 * @version 1.0
 * @author Troy T. Hall (http://jowwow.me)
 * @copyright (C) 2013 JowWow
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Include the syndicate functions only once
if(!defined('DS')){
    define('DS',DIRECTORY_SEPARATOR);
}
require_once( dirname(__FILE__).DS.'helper.php' );
 
 // Get default .css file
 $document = JFactory::getDocument();
$document->addStyleSheet( JURI::base() . 'modules/mod_jowclock/css/mod_jowclock.css');
 
$time = modJowClockHelper::getTime( $params );
$format = $params->get('format');
$seconds = $params->get('seconds');
$date = $params->get('date');
$leadingZeros = $params->get('leadingZeros');
$outTimezone = modJowClockHelper::getOutputTimezone( $params );
require( JModuleHelper::getLayoutPath( 'mod_jowclock' ) );
