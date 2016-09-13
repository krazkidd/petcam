<?php

require_once dirname(__FILE__) . '/local-config.php';
require_once dirname(__FILE__) . '/../lib/lib.php';

//TODO validate local-config.php settings

// for date functions
if (defined('TIMEZONE')
{
    date_default_timezone_set(TIMEZONE);
}

//TODO I really can't just look at the earliest image. The user could
//     have cameras in multiple locations uploading images. I need to
//     check for any timestamps that are within UPDATE_INTERVAL
//     minutes of the current time and get the oldest one of those.

// we can expect a new image UPDATE_INTERVAL minutes after the oldest
// image; subtract the current time from that to get the time when the
// user should refresh the page
$refreshTime = getEarliestModTime() + UPDATE_INTERVAL * 60 - time();

// add a small buffer to account for network latency and image upload
// time (this prevents two things: a double refresh where the page
// refreshes before a new image is uploaded--the page still sees the
// old image and sets a small refresh interval, and making the cam
// appear offline for being slower than we expect)
$refreshTime += 15;

if ($refreshTime >= 0)
{
    // if refresh time is non-negative, then there's a good chance
    // a new image will be available at that time

    // don't allow a refresh time less than 5 seconds
    $refreshTime = max($refreshTime, 5);
}
else if ($refreshTime >= -UPDATE_INTERVAL * 60)
{
    // if refresh time is negative but within UPDATE_INTERVAL
    // minutes, the camera may be offline but we're going to try
    // one more refresh

    // we set the refresh time to UPDATE_INTERVAL minutes so that
    // *at most* one automatic refresh occurs
    $refreshTime = UPDATE_INTERVAL * 60;
}

if ($refreshTime > 0)
{
    // add a small random amount (0 - 30 seconds) so we don't have
    // all clients refreshing at the same time
    define('REFRESH_TIME', $refreshTime + rand(0, 6) * 5);
}

// unset working variables
unset($refreshTime);

