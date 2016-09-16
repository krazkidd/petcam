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
    return filemtime(getImagePath($camNum));
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

        if ($ftime)
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

        if ($ftime)
            $mtime = max($mtime, $ftime);
    }

    define('__LATEST_MOD_TIME', $mtime);

    return __LATEST_MOD_TIME;
}

function getFormattedTimeLong($time)
{
    if (defined('DATE_FMT_LONG'))
    {
        return date(DATE_FMT_LONG, $time);
    }
    else
    {
        return date(DATE_RFC850, $time);
    }
}

function getCamIdentifier($camNum)
{
    return "Cam #$camNum";
}

function isCamOnline($camNum)
{
    $mtime = getModTime($camNum);

    if ( !$mtime || $mtime == 0)
        return false;
    else if ($mtime + UPDATE_INTERVAL * 60 - time() < -15)
        return false;

    return true;
}

function getCamStatus($camNum)
{
    $mtime = getModTime($camNum);

    if ( !$mtime || $mtime == 0)
        $isOnline = false;
    else if ($mtime + UPDATE_INTERVAL * 60 - time() < -15)
        $isOnline = false;
    else
        $isOnline = true;

    if ($isOnline)
        return 'Online';
    else
        return 'Offline';
}

