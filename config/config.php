<?php

require_once dirname(__FILE__) . '/local-config.php';

//TODO move to another file
function getImagePath($camNum)
{
    return IMG_LOC . $camNum . "." . IMG_EXT;
}

// get earliest modified time of all images
$fmtime = PHP_INT_MAX;
for ($i = 1; $i <= NUM_CAMS; $i++)
{
    $nextfmtime = filemtime(getImagePath($i));

    if ($fmtime > $nextfmtime)
        $fmtime = $nextfmtime;
}

$currTime = time();

// prevent overflow in next step if, say, none of the files existed (and so $fmtime == PHP_INT_MAX)
//TODO what actually happens in case when files don't exist?
$fmtime = min($fmtime, $currTime);

// set refresh time
// the upload script runs every 5 minutes; we look at the mtime of the image and the current
// time to see if we can refresh earlier than that, in order to get a fresh image as soon
// as it's available
$refreshTime = $fmtime + UPDATE_INTERVAL * 60 - $currTime + 5;

// if refresh time is non-negative, set a refresh interval
if ($refreshTime >= 0)
{
    //TODO this accounts for the bug I was having where refresh time was 200+ seconds because I was
    //     preserving mtime when uploading the image through FTP. This should prevent that. 
    //     BUT, I can't bring back that preservation option without checking how FTP deals with timezones
    //     between uploader and server
    define("REFRESH_TIME", min(min($refreshTime, 5), UPDATE_INTERVAL + 5));
}

