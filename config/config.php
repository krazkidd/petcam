<?php

require_once dirname(__FILE__) . '/local-config.php';
require_once dirname(__FILE__) . '/../lib/lib.php';

//TODO validate local-config.php settings

// for date functions
if (defined('TIMEZONE'))
{
    date_default_timezone_set(TIMEZONE);
}

// we can expect a new image UPDATE_INTERVAL minutes after the oldest
// image; subtract the current time from that to get the time when the
// user should refresh the page
$time = time();
$mtime = getEarliestOnlineModTimeRelativeTo($time);

if ($mtime >= 0)
{
    // NOTE: The +15 is a buffer to account for network
    //       latency and image upload time.
    $refreshTime = $mtime + UPDATE_INTERVAL * 60 + 15 - $time;

    if ($refreshTime >= 0)
    {
        // if refresh time is non-negative, then there's a good chance
        // a new image will be available at that time

        // don't allow a refresh time less than 5 seconds
        $refreshTime = max($refreshTime, 5);

        // add a small random amount (0 - 30 seconds) so we don't have
        // all clients refreshing at the same time
        define('REFRESH_TIME', $refreshTime + rand(0, 6) * 5);
    }
}

// unset working variables
unset($time, $mtime, $refreshTime);

