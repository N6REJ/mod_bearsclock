<?php
/**
 * @package JowClock for Joomla 3.0
 * @version 1.1
 * @author Troy T. Hall (http://jowwow.me)
 * @copyright (C) 2013 JowWow
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
$moduleTitle = $module->title;
$moduleTitle = strtolower($moduleTitle);
$moduleTitle = preg_replace('/[^a-z0-9]/i', '_', $moduleTitle);
$moduleSuffix = $params->get('moduleclass_sfx');
?>

<!-- BEGIN LAYOUT -->
<!-- Vertical layout -->
<?php if ($params->get('layout') == "vert") { ?>
    <div id = "JowClock-vert_<?php echo $moduleTitle; ?>">
        <!-- Timezone Before -->
        <?php if ($params->get('show-timezone') == "yes" && $params->get('timezone-position') == "before") { ?>

            <div id = "JowClockTimezone_<?php echo $moduleTitle; ?>" class="JowClockTimezone" >
                <?php echo $outTimezone; ?>
            </div>

        <?php } ?>
        <!-- Date -->
        <?php if ($params->get('date') != "no") { ?>

            <div id = "JowClockDate_<?php echo $moduleTitle; ?>" class="JowClockDate" >
            </div>

        <?php } ?>	
        <!-- Time -->

        <div id= "JowClockTime_<?php echo $moduleTitle; ?>" class="JowClockTime" >
        </div>

        <!-- Timezone After -->
        <?php if ($params->get('show-timezone') == "yes" && $params->get('timezone-position') == "after") { ?>

            <div id = "JowClockTimezone_<?php echo $moduleTitle; ?>" class="JowClockTimezone" >
                <?php echo $outTimezone; ?>
            </div>

        <?php } ?>
    </div>

    <!-- END Vertical layout -->
<?php } else { ?>

    <!-- Horizontal layout -->
    <div id = "JowClock-horz_<?php echo $moduleTitle; ?>">		
        <!-- Timezone Before -->
        <?php if ($params->get('show-timezone') == "yes" && $params->get('timezone-position') == "before") { ?>
            <span id = "JowClockTimezone_<?php echo $moduleTitle; ?>" class="JowClockTimezone" >
                <?php echo $outTimezone; ?>
            </span>
        <?php } ?>
        <!-- Date -->
        <?php if ($params->get('date') != "no") { ?>
            <span id = "JowClockDate_<?php echo $moduleTitle; ?>" class="JowClockDate" >
            </span>
        <?php } ?>	
        <!-- Time -->
        <span id= "JowClockTime_<?php echo $moduleTitle; ?>" class="JowClockTime" >
        </span>			

        <!-- Timezone After -->
        <?php if ($params->get('show-timezone') == "yes" && $params->get('timezone-position') == "after") { ?>
            <span id = "JowClockTimezone_<?php echo $moduleTitle; ?>" class="JowClockTimezone" >
                <?php $outTimezone; ?>
            </span>
        <?php } ?>
    </div>
    <!-- END Horizontal layout -->
    <?php }
?>
<!-- END LAYOUT -->
<script type="text/javascript" >
    var currentTime_<?php echo $moduleTitle; ?> = new Date("<?php echo $time; ?>");
    var format_<?php echo $moduleTitle; ?> = "<?php echo $format; ?>";
    var seconds_<?php echo $moduleTitle; ?> = "<?php echo $seconds; ?>";
    var date_<?php echo $moduleTitle; ?> = "<?php echo $date; ?>";
    var leadingZeros_<?php echo $moduleTitle; ?> = "<?php echo $leadingZeros; ?>";
    var jstime_<?php echo $moduleTitle; ?> = new Date().getTime() - 1000;
    function JowClockUpdate_<?php echo $moduleTitle; ?>()
    {
        jstime_<?php echo $moduleTitle; ?> = jstime_<?php echo $moduleTitle; ?> + 1000;
        var jsnow_<?php echo $moduleTitle; ?> = new Date().getTime();
        var offset_<?php echo $moduleTitle; ?> = jsnow_<?php echo $moduleTitle; ?> - jstime_<?php echo $moduleTitle; ?>;
        if (offset_<?php echo $moduleTitle; ?> > 1000) {
            jstime_<?php echo $moduleTitle; ?> = jstime_<?php echo $moduleTitle; ?> + offset_<?php echo $moduleTitle; ?>;
            var offsetseconds_<?php echo $moduleTitle; ?> = Math.round(offset_<?php echo $moduleTitle; ?> / 1000);
            currentTime_<?php echo $moduleTitle; ?>.setSeconds(currentTime_<?php echo $moduleTitle; ?>.getSeconds() + offsetseconds_<?php echo $moduleTitle; ?>);
        }
        currentTime_<?php echo $moduleTitle; ?>.setSeconds(currentTime_<?php echo $moduleTitle; ?>.getSeconds() + 1);
        var currentHours_<?php echo $moduleTitle; ?> = currentTime_<?php echo $moduleTitle; ?>.getHours();
        var currentMinutes_<?php echo $moduleTitle; ?> = currentTime_<?php echo $moduleTitle; ?>.getMinutes();
        var currentSeconds_<?php echo $moduleTitle; ?> = currentTime_<?php echo $moduleTitle; ?>.getSeconds();
        // Handles 12h format
        if (format_<?php echo $moduleTitle; ?> == "12h") {
            //convert 24 to 00
            if (currentHours_<?php echo $moduleTitle; ?> == 24) {
                currentHours_<?php echo $moduleTitle; ?> = 0;
            }
            //save a AM/PM variable
            if (currentHours_<?php echo $moduleTitle; ?> < 12) {
                var ampm_<?php echo $moduleTitle; ?> = "AM";
            }
            if (currentHours_<?php echo $moduleTitle; ?> >= 12) {
                var ampm_<?php echo $moduleTitle; ?> = "PM";
                if (currentHours_<?php echo $moduleTitle; ?> > 12) {
                    currentHours_<?php echo $moduleTitle; ?> = currentHours_<?php echo $moduleTitle; ?> - 12;
                }
            }
        }
        // Pad the hours, minutes and seconds with leading zeros, if required
        if (leadingZeros_<?php echo $moduleTitle; ?> == "yes") {
            currentHours_<?php echo $moduleTitle; ?> = (currentHours_<?php echo $moduleTitle; ?> < 10 ? "0" : "") + currentHours_<?php echo $moduleTitle; ?>;
            currentMinutes_<?php echo $moduleTitle; ?> = (currentMinutes_<?php echo $moduleTitle; ?> < 10 ? "0" : "") + currentMinutes_<?php echo $moduleTitle; ?>;
            currentSeconds_<?php echo $moduleTitle; ?> = (currentSeconds_<?php echo $moduleTitle; ?> < 10 ? "0" : "") + currentSeconds_<?php echo $moduleTitle; ?>;
        }
        // Compose the string for display
        var currentTimeString_<?php echo $moduleTitle; ?> = currentHours_<?php echo $moduleTitle; ?> + ":" + currentMinutes_<?php echo $moduleTitle; ?>;
        // Add seconds if that has been selected
        if (seconds_<?php echo $moduleTitle; ?> == "yes") {
            currentTimeString_<?php echo $moduleTitle; ?> = currentTimeString_<?php echo $moduleTitle; ?> + ":" + currentSeconds_<?php echo $moduleTitle; ?>;
        }
        // Add AM/PM if 12h format
        if (format_<?php echo $moduleTitle; ?> == "12h") {
            currentTimeString_<?php echo $moduleTitle; ?> = currentTimeString_<?php echo $moduleTitle; ?> + " " + ampm_<?php echo $moduleTitle; ?>;
        }
        // Handle date formating
        if (date_<?php echo $moduleTitle; ?> != "no") {
            var date = currentTime_<?php echo $moduleTitle; ?>.getDate();
            var month = currentTime_<?php echo $moduleTitle; ?>.getMonth() + 1;
            var year = currentTime_<?php echo $moduleTitle; ?>.getFullYear();
            var day = currentTime_<?php echo $moduleTitle; ?>.getDay();
            var textMonth = "null";

            // Get day & month type param from J!
            var daytype = "<?php echo $params->get('daytype'); ?>";
            var monthtype = "<?php echo $params->get('monthtype'); ?>";

            //translate to human
            if (month < 10)
                month = "0" + month;

            // Choose day length
            if (daytype == "short") {
                if (day == 1) {
                    day = "Mon";
                }
                if (day == 2) {
                    day = "Tue";
                }
                if (day == 3) {
                    day = "Wed";
                }
                if (day == 4) {
                    day = "Thu";
                }
                if (day == 5) {
                    day = "Fri";
                }
                if (day == 6) {
                    day = "Sat";
                }
                if (day == 0) {
                    day = "Sun";
                }
            } else {
                // Okay, its long type
                if (day == 1) {
                    day = "Monday";
                }
                if (day == 2) {
                    day = "Tuesday";
                }
                if (day == 3) {
                    day = "Wednesday";
                }
                if (day == 4) {
                    day = "Thursday";
                }
                if (day == 5) {
                    day = "Friday";
                }
                if (day == 6) {
                    day = "Saturday";
                }
                if (day == 0) {
                    day = "Sunday";
                }
            }

            // Choose Month length
            if (monthtype == "short") {
                if (month == "01") {
                    textMonth = "Jan";
                }
                if (month == "02") {
                    textMonth = "Feb";
                }
                if (month == "03") {
                    textMonth = "Mar";
                }
                if (month == "04") {
                    textMonth = "Apr";
                }
                if (month == "05") {
                    textMonth = "May";
                }
                if (month == "06") {
                    textMonth = "Jun";
                }
                if (month == "07") {
                    textMonth = "Jul";
                }
                if (month == "08") {
                    textMonth = "Aug";
                }
                if (month == "09") {
                    textMonth = "Sep";
                }
                if (month == "10") {
                    textMonth = "Oct";
                }
                if (month == "11") {
                    textMonth = "Nov";
                }
                if (month == "12") {
                    textMonth = "Dec";
                }
            } else {
                if (month == "01") {
                    textMonth = "January";
                }
                if (month == "02") {
                    textMonth = "February";
                }
                if (month == "03") {
                    textMonth = "March";
                }
                if (month == "04") {
                    textMonth = "April";
                }
                if (month == "05") {
                    textMonth = "May";
                }
                if (month == "06") {
                    textMonth = "June";
                }
                if (month == "07") {
                    textMonth = "July";
                }
                if (month == "08") {
                    textMonth = "August";
                }
                if (month == "09") {
                    textMonth = "September";
                }
                if (month == "10") {
                    textMonth = "October";
                }
                if (month == "11") {
                    textMonth = "November";
                }
                if (month == "12") {
                    textMonth = "December";
                }
            }

            if (leadingZeros_<?php echo $moduleTitle; ?> == "no") {
                if (month.charAt(0) === '0') {
                    month = month.substr(1);
                }
                if (date.charAt(0) === '0') {
                    date = date.substr(1);
                }
            }
            //Compose date string
            switch (date_<?php echo $moduleTitle; ?>) {
                case "format1":
                    currentDate_<?php echo $moduleTitle; ?> = year + "-" + month + "-" + date;
                    break;
                case "format2":
                    currentDate_<?php echo $moduleTitle; ?> = year + "/" + month + "/" + date;
                    break;
                case "format3":
                    currentDate_<?php echo $moduleTitle; ?> = date + "/" + month + "/" + year;
                    break;
                case "format4":
                    currentDate_<?php echo $moduleTitle; ?> = month + "/" + date + "/" + year;
                    break;
                case "format5":
                    currentDate_<?php echo $moduleTitle; ?> = date + " " + textMonth;
                    break;
                case "format6":
                    currentDate_<?php echo $moduleTitle; ?> = day + " " + date + " " + textMonth;
                    break;
                case "format7":
                    currentDate_<?php echo $moduleTitle; ?> = textMonth + " " + date;
                    break;
                case "format8":
                    currentDate_<?php echo $moduleTitle; ?> = textMonth + " " + date + ", " + year;
                    break;
                case "format9":
                    currentDate_<?php echo $moduleTitle; ?> = day + " " + textMonth + " " + date;
                    break;
            }
        }
        // Update the time display
        document.getElementById("JowClockTime_<?php echo $moduleTitle; ?>").innerHTML = currentTimeString_<?php echo $moduleTitle; ?>;
        if (date_<?php echo $moduleTitle; ?> != "no") {
            document.getElementById("JowClockDate_<?php echo $moduleTitle; ?>").innerHTML = currentDate_<?php echo $moduleTitle; ?>;
        }
    }
    JowClockUpdate_<?php echo $moduleTitle; ?>();
    setInterval('JowClockUpdate_<?php echo $moduleTitle; ?>()', 1000);
</script>