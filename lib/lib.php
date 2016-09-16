<?php

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

/*
 * Gets the modification time of the earliest
 * modified image.
 */
function getEarliestModTime()
{
    if (defined('__EARLIEST_MOD_TIME'))
        return __EARLIEST_MOD_TIME;

    $mtime = PHP_INT_MAX;

    for ($i = 1; $i <= NUM_CAMS; $i++)
    {
        $ftime = getModTime($i);

        //TODO what do if $ftime = 0? will first test fail?
        if ($ftime && $ftime >= 0)
            $mtime = min($mtime, $ftime);
    }

    if ($mtime == PHP_INT_MAX)
        $mtime = 0;

    define('__EARLIEST_MOD_TIME', $mtime);

    return __EARLIEST_MOD_TIME;
}

/*
 * Gets the modification time of the latest
 * modified image.
 */
function getLatestModTime()
{
    if (defined('__LATEST_MOD_TIME'))
        return __LATEST_MOD_TIME;

    $mtime = 0;

    for ($i = 1; $i <= NUM_CAMS; $i++)
    {
        $ftime = getModTime($i);

        if ($ftime && $ftime >= 0)
            $mtime = max($mtime, $ftime);
    }

    define('__LATEST_MOD_TIME', $mtime);

    return __LATEST_MOD_TIME;
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

        if ( !$mtime || $mtime + UPDATE_INTERVAL * 60 - time() < -15)
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

