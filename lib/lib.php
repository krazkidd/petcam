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

require_once dirname(__FILE__) . '/../config/config.php';

/*
 * Gets the path to the image for the given
 * camera.
 */
function getImagePath($camNum)
{
    return IMG_LOC . $camNum . "." . IMG_EXT;
}

function getModTime($camNum)
{
    $path = getImagePath($camNum);

    if (file_exists($path))
         return filemtime($path);

    return -1;
}

function isOnlineTimestamp($timestamp, $time)
{
    // NOTE: The +15 is a buffer to account for network
    //       latency and image upload time.
    return $timestamp + UPDATE_INTERVAL * 60 + 15 - $time >= 0;
}

/*
 * Gets the modification time of the earliest
 * modified image out of all the cameras that
 * are considered "online" with the given
 * timestamp.
 */
function getEarliestOnlineModTimeRelativeTo($time)
{
    $mtime = PHP_INT_MAX;

    for ($i = 1; $i <= NUM_CAMS; $i++)
    {
        $ftime = getModTime($i);

        //TODO what do if $ftime = 0? will first test fail?
        if ($ftime && $ftime >= 0)
        {
            if (isOnlineTimestamp($ftime, $time))
                $mtime = min($mtime, $ftime);
        }
    }

    if ($mtime == PHP_INT_MAX)
        return -1;

    return $mtime;
}

function getFormattedTimeLong($time)
{
    if (defined('DATE_FMT_LONG'))
        return date(DATE_FMT_LONG, $time);

    return date(DATE_RFC850, $time);
}

function getCamIdentifier($camNum)
{
    return "Cam #$camNum";
}

function isCamOnline($camNum)
{
    if (isCamAvailable($camNum))
    {
        $mtime = getModTime($camNum);

        if ( !$mtime || !isOnlineTimestamp($mtime, time()))
            return false;
        else
            return true;
    }

    return false;
}

function isCamAvailable($camNum)
{
    return getModTime($camNum) >= 0;
}

function getCamStatus($camNum)
{
    if ( !isCamAvailable($camNum))
        return 'Unavailable';
    else if ( !isCamOnline($camNum))
        return 'Offline';

    return 'Online';
}

