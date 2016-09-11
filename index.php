<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
    define("MOBY_IMG_LOC", "images/moby-latest");
    define("UPDATE_INTERVAL", 60 * 5);
    define("NUM_CAMS", 2);
    define("CURR_TIME", time());
?>

<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <?php
        // get earliest modified time of all images
        $fmtime = PHP_INT_MAX;
        for ($i = 1; $i <= NUM_CAMS; $i++) {
            $nextfmtime = filemtime(MOBY_IMG_LOC . "-cam" . $i . ".jpg");

            if ($fmtime > $nextfmtime)
                $fmtime = $nextfmtime;
        }

        // prevent overflow in next step if, say, none of the files existed (and so $fmtime == PHP_INT_MAX)
        //TODO what actually happens in case when files don't exist?
        $fmtime = min($fmtime, CURR_TIME);
        
        // set refresh time
        // the upload script runs every 5 minutes; we look at the mtime of the image and the current
        // time to see if we can refresh earlier than that, in order to get a fresh image as soon
        // as it's available
        $refreshTime = $fmtime + UPDATE_INTERVAL - CURR_TIME + 5;

        // if refresh time is negative, the camera must be down. Don't refresh
        if ($refreshTime <= 0) // don't set a refresh of 0
            unset($refreshTime);
        else {
            //TODO this accounts for the bug I was having where refresh time was 200+ seconds because I was
            //     preserving mtime when uploading the image through FTP. This should prevent that. 
            //     BUT, I can't bring back that preservation option without checking how FTP deals with timezones
            //     between uploader and server
            $refreshTime = min($refreshTime, UPDATE_INTERVAL + 5);
    ?>
            <meta http-equiv="refresh" content="<?= $refreshTime ?>" />
    <?php
        }
    ?>
    <title>See Moby (and Zoe) LIVE! - moby.krazkidd.net</title>
    <link rel="icon" type="image/png" href="images/dog13.png" />
    <link href="styles/style.css" media="screen,print" rel="stylesheet" title="CSS" type="text/css" />
</head>

<body id="body-index">
            
    <h1>See Moby (and Zoe) LIVE!</h1>

    <div id="moby-img">
        <p>Cam #1</p>
        <img src="<?= MOBY_IMG_LOC . "-cam1.jpg" ?>" alt="Latest LIVE image from cam #1" />

        <p>Cam #2</p>
        <img src="<?= MOBY_IMG_LOC . "-cam2.jpg" ?>" alt="Latest LIVE image from cam #2" />

        <?php
            if (isset($refreshTime)) {
        ?>
                <p>New pictures are uploaded every few minutes. This page will automatically refresh in <?= $refreshTime ?> second<?= $refreshTime == 1 ? "" : "s" ?> in 
                order to show a new picture!</p>
        <?php
            }
            else {
        ?>
                <p>The cameras appear to be offline--they can go down for various reasons. The latest images shown above
                were taken on <?= date(DATE_RFC850, $fmtime) ?>. Please try again later.
        <?php
            }
        ?>
    </div>

    <div id="footer">
        <p>This site was created by <a href="http://krazkidd.net">Mark Ross</a>. <a href="about.html">Why? How?</a></p>
    </div>

    <div id="license">Favicon made by <a href="http://www.freepik.com" alt="Freepik.com" title="Freepik.com">Freepik</a> from <a href="http://www.flaticon.com/free-icon/dog-silhouette-in-a-sitting-position_26129" title="Flaticon">www.flaticon.com</a></div>

</body>
</html>
