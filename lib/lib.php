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
        $ftime = filemtime(getImagePath($i));

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
        $ftime = filemtime(getImagePath($i));

        if ($ftime)
            $mtime = max($mtime, $ftime);
    }

    define('__LATEST_MOD_TIME', $mtime);

    return __LATEST_MOD_TIME;
}

