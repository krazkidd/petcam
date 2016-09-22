<?php

/**************************************************************************

This file is a part of Petcam.

Copyright © 2014, 2016 Mark Ross <krazkidd@gmail.com>

Petcam is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published
by the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Petcam is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with Petcam.  If not, see <http://www.gnu.org/licenses/>.

**************************************************************************/

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

        if (defined(REFRESH_RND) && REFRESH_RND)
            $refreshTime += rand(0, 30);

        // add a small random amount (0 - 30 seconds) so we don't have
        // all clients refreshing at the same time
        define('REFRESH_TIME', $refreshTime);
    }
}

// unset working variables
unset($time, $mtime, $refreshTime);

