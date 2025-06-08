<?php
/**
 * @package           BearsClock for Joomla 5
 * @author            Troy T. Hall (http://bearswow.me)
 * @copyright     (C) 2013-2025 JowWow
 * @license           GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @var Joomla\CMS\Registry\Registry $params
 * @var Joomla\CMS\Module\Module     $module
 * @var string                       $outTimezone
 * @var string                       $time
 * @var string                       $format
 **/

// No direct access
// (Joomla 5 modules do not require this, but kept for legacy compatibility)
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

$moduleTitle  = $module->title;
$moduleTitle  = strtolower($moduleTitle);
$moduleTitle  = preg_replace('/[^a-z0-9]/i', '_', $moduleTitle);
$moduleSuffix = $params->get('moduleclass_sfx');

// Get all params as variables for easier JS export
$showTimezone     = $params->get('show-timezone', '1');
$timezonePosition = $params->get('timezone-position', 'after');
$date             = $params->get('date', 'format1');
$layout           = $params->get('layout', '0');
$seconds          = $params->get('seconds', '1');
$leadingZeros     = $params->get('leadingZeros', '1');
$daytype          = $params->get('daytype', '1');
$monthtype        = $params->get('monthtype', '1');

?>
<!-- BEGIN LAYOUT -->
<?php
if ($layout === "1") { // Vertical layout ?>
	<div id = "BearsClock-vert">
		<!-- Timezone Before -->
        <?php
        if ($showTimezone === "1" && $timezonePosition === "before") { ?>
			<div id = "BearsClockTimezone_<?php
            echo $moduleTitle; ?>" class = "BearsClockTimezone<?php
            echo $moduleSuffix; ?>">
                <?php
                echo " " . $outTimezone . " "; ?>
			</div>
        <?php
        } ?>
		<!-- Date -->
        <?php
        if ($date !== "no") { ?>
			<div id = "BearsClockDate_<?php
            echo $moduleTitle; ?>" class = "BearsClockDate<?php
            echo $moduleSuffix; ?>"></div>
        <?php
        } ?>
		<!-- Time -->
		<div id = "BearsClockTime_<?php
        echo $moduleTitle; ?>" class = "BearsClockTime<?php
        echo $moduleSuffix; ?>"></div>
		<!-- Timezone After -->
        <?php
        if ($showTimezone === "1" && $timezonePosition === "after") { ?>
			<div id = "BearsClockTimezone_<?php
            echo $moduleTitle; ?>" class = "BearsClockTimezone<?php
            echo $moduleSuffix; ?>">
                <?php
                echo " " . $outTimezone . " "; ?>
			</div>
        <?php
        } ?>
	</div>
<?php
} else { // Horizontal layout ?>
	<div id = "BearsClock-horz_<?php
    echo $moduleTitle; ?>">
		<!-- Timezone Before -->
        <?php
        if ($showTimezone === "1" && $timezonePosition === "before") { ?>
			<span id = "BearsClockTimezone_<?php
            echo $moduleTitle; ?>" class = "BearsClockTimezone<?php
            echo $moduleSuffix; ?>">
                <?php
                echo $outTimezone . " "; ?>
            </span>
        <?php
        } ?>
		<!-- Date -->
        <?php
        if ($date !== "no") { ?>
			<span id = "BearsClockDate_<?php
            echo $moduleTitle; ?>" class = "BearsClockDate<?php
            echo $moduleSuffix; ?>"></span>
        <?php
        } ?>
		<!-- Time -->
		<span id = "BearsClockTime_<?php
        echo $moduleTitle; ?>" class = "BearsClockTime<?php
        echo $moduleSuffix; ?>"></span>
		<!-- Timezone After -->
        <?php
        if ($showTimezone === "1" && $timezonePosition === "after") { ?>
			<span id = "BearsClockTimezone_<?php
            echo $moduleTitle; ?>" class = "BearsClockTimezone<?php
            echo $moduleSuffix; ?>">
                <?php
                echo " " . $outTimezone; ?>
            </span>
        <?php
        } ?>
	</div>
<?php
} ?>
<!-- END LAYOUT -->
<script type = "text/javascript">
    let currentTime_<?php echo $moduleTitle; ?> = new Date("<?php echo $time; ?>");
    const format_<?php echo $moduleTitle; ?> = "<?php echo $format; ?>";
    const seconds_<?php echo $moduleTitle; ?> = "<?php echo $seconds; ?>";
    const date_<?php echo $moduleTitle; ?> = "<?php echo $date; ?>";
    const leadingZeros_<?php echo $moduleTitle; ?> = "<?php echo $leadingZeros; ?>";
    const layout_<?php echo $moduleTitle; ?> = "<?php echo $layout; ?>";
    const daytype_<?php echo $moduleTitle; ?> = "<?php echo $daytype; ?>";
    const monthtype_<?php echo $moduleTitle; ?> = "<?php echo $monthtype; ?>";
    let jstime_<?php echo $moduleTitle; ?> = new Date().getTime() - 1000;

    function BearsClockUpdate_<?php echo $moduleTitle; ?>() {
        jstime_<?php echo $moduleTitle; ?> += 1000;
        let jsnow_<?php echo $moduleTitle; ?> = new Date().getTime();
        let offset_<?php echo $moduleTitle; ?> = jsnow_<?php echo $moduleTitle; ?> - jstime_<?php echo $moduleTitle; ?>;
        if (offset_<?php echo $moduleTitle; ?> > 1000) {
            jstime_<?php echo $moduleTitle; ?> += offset_<?php echo $moduleTitle; ?>;
            let offsetseconds_<?php echo $moduleTitle; ?> = Math.round(offset_<?php echo $moduleTitle; ?> / 1000);
            currentTime_<?php echo $moduleTitle; ?>.setSeconds(currentTime_<?php echo $moduleTitle; ?>.getSeconds() + offsetseconds_<?php echo $moduleTitle; ?>);
        }
        currentTime_<?php echo $moduleTitle; ?>.setSeconds(currentTime_<?php echo $moduleTitle; ?>.getSeconds() + 1);
        let currentHours_<?php echo $moduleTitle; ?> = currentTime_<?php echo $moduleTitle; ?>.getHours();
        let currentMinutes_<?php echo $moduleTitle; ?> = currentTime_<?php echo $moduleTitle; ?>.getMinutes();
        let currentSeconds_<?php echo $moduleTitle; ?> = currentTime_<?php echo $moduleTitle; ?>.getSeconds();
        let ampm_<?php echo $moduleTitle; ?> = "";
        // Handles 12h format
        if (format_<?php echo $moduleTitle; ?> === "12h") {
            if (currentHours_<?php echo $moduleTitle; ?> === 24) {
                currentHours_<?php echo $moduleTitle; ?> = 0;
            }
            if (currentHours_<?php echo $moduleTitle; ?> < 12) {
                ampm_<?php echo $moduleTitle; ?> = "AM";
            } else {
                ampm_<?php echo $moduleTitle; ?> = "PM";
                if (currentHours_<?php echo $moduleTitle; ?> > 12) {
                    currentHours_<?php echo $moduleTitle; ?> -= 12;
                }
            }
        }
        // Pad the hours, minutes and seconds with leading zeros, if required
        if (leadingZeros_<?php echo $moduleTitle; ?> === "time" || leadingZeros_<?php echo $moduleTitle; ?> === "both") {
            currentHours_<?php echo $moduleTitle; ?> = (currentHours_<?php echo $moduleTitle; ?> < 10 ? "0" : "") + currentHours_<?php echo $moduleTitle; ?>;
            currentMinutes_<?php echo $moduleTitle; ?> = (currentMinutes_<?php echo $moduleTitle; ?> < 10 ? "0" : "") + currentMinutes_<?php echo $moduleTitle; ?>;
            currentSeconds_<?php echo $moduleTitle; ?> = (currentSeconds_<?php echo $moduleTitle; ?> < 10 ? "0" : "") + currentSeconds_<?php echo $moduleTitle; ?>;
        }
        // Compose the string for display
        let currentTimeString_<?php echo $moduleTitle; ?> = currentHours_<?php echo $moduleTitle; ?> + ":" + currentMinutes_<?php echo $moduleTitle; ?>;
        // Add seconds if that has been selected
        if (seconds_<?php echo $moduleTitle; ?> === "1") {
            currentTimeString_<?php echo $moduleTitle; ?> += ":" + currentSeconds_<?php echo $moduleTitle; ?>;
        }
        // Add AM/PM if 12h format
        if (format_<?php echo $moduleTitle; ?> === "12h") {
            currentTimeString_<?php echo $moduleTitle; ?> += " " + ampm_<?php echo $moduleTitle; ?>;
        }
        // Handle date formatting
        let dayName;
        let textMonth;
        if (date_<?php echo $moduleTitle; ?> !== "no") {
            let date = currentTime_<?php echo $moduleTitle; ?>.getDate();
            let month = currentTime_<?php echo $moduleTitle; ?>.getMonth() + 1;
            let year = currentTime_<?php echo $moduleTitle; ?>.getFullYear();
            let day = currentTime_<?php echo $moduleTitle; ?>.getDay();

            // Prepare string versions for display
            let monthStr = month < 10 ? "0" + month : String(month);
            let dateStr = date < 10 ? "0" + date : String(date);

            // Remove leading zeros from date if needed
            if (leadingZeros_<?php echo $moduleTitle; ?> === "date" || leadingZeros_<?php echo $moduleTitle; ?> === "none") {
                if (monthStr.charAt(0) === '0') {
                    monthStr = monthStr.substring(1);
                }
                if (dateStr.charAt(0) === '0') {
                    dateStr = dateStr.substring(1);
                }
            }

            // Choose day length
            if (daytype_<?php echo $moduleTitle; ?> === "1") {
                dayName = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"][day];
            } else {
                dayName = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"][day];
            }

            // Choose Month length
            if (monthtype_<?php echo $moduleTitle; ?> === "1") {
                textMonth = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"][month - 1];
            } else {
                textMonth = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][month - 1];
            }

            //Compose date string
            let currentDate_<?php echo $moduleTitle; ?> = "";
            switch (date_<?php echo $moduleTitle; ?>) {
                case "format1":
                    currentDate_<?php echo $moduleTitle; ?> = year + "-" + monthStr + "-" + dateStr;
                    break;
                case "format2":
                    currentDate_<?php echo $moduleTitle; ?> = year + "/" + monthStr + "/" + dateStr;
                    break;
                case "format3":
                    currentDate_<?php echo $moduleTitle; ?> = dateStr + "/" + monthStr + "/" + year;
                    break;
                case "format4":
                    currentDate_<?php echo $moduleTitle; ?> = monthStr + "/" + dateStr + "/" + year;
                    break;
                case "format5":
                    currentDate_<?php echo $moduleTitle; ?> = dateStr + " " + textMonth;
                    break;
                case "format6":
                    currentDate_<?php echo $moduleTitle; ?> = dayName + " " + dateStr + " " + textMonth;
                    break;
                case "format7":
                    currentDate_<?php echo $moduleTitle; ?> = textMonth + " " + dateStr;
                    break;
                case "format8":
                    currentDate_<?php echo $moduleTitle; ?> = textMonth + " " + dateStr + ", " + year;
                    break;
                case "format9":
                    currentDate_<?php echo $moduleTitle; ?> = dayName + " " + textMonth + " " + dateStr;
                    break;
            }
            document.getElementById("BearsClockDate_<?php echo $moduleTitle; ?>").innerHTML = currentDate_<?php echo $moduleTitle; ?>;
        }
        // Update the time display
        document.getElementById("BearsClockTime_<?php echo $moduleTitle; ?>").innerHTML = currentTimeString_<?php echo $moduleTitle; ?>;
    }

    BearsClockUpdate_<?php echo $moduleTitle; ?>();
    setInterval(BearsClockUpdate_<?php echo $moduleTitle; ?>, 1000);
</script>
