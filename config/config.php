<?php

require_once dirname(__FILE__) . '/local-config.php';
require_once dirname(__FILE__) . '/../lib/lib.php';

//TODO I really can't just look at the earliest image. The user could
//     have cameras in multiple locations uploading images. I need to
//     get the oldest image timestamp that is within UPDATE_INTERVAL
//     minutes of the current time.
//TODO given the note above, add a online/offline status to each individual image 

// we can expect a new image UPDATE_INTERVAL minutes after the oldest image
$refreshTime = getEarliestModTime() + UPDATE_INTERVAL * 60 - time();

// if refresh time is non-negative, set a refresh interval; if it's
// negative, that means no new images are being uploaded. allow a
// small buffer, though
if ($refreshTime >= -15)
{
    // don't allow a refresh time less than 5 seconds
    define('REFRESH_TIME', max($refreshTime, 5));
}

