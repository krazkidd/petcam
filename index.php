<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
/**************************************************************************

This file is a part of Petcam, a simple way to make webcam images available
on the Web.
Copyright © 2014, 2016 Mark Ross <krazkidd@gmail.com>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published
by the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

**************************************************************************/
?>

<?php require_once 'config/config.php' ?>
<?php require_once 'lib/lib.php' ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">

<head>
    <title>Pet Cam - Home</title>

    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <link rel="icon" type="image/png" href="images/dog13.png" />
    <link rel="stylesheet" href="styles/style1.css" type="text/css" media="screen,print" />
<?php if (defined('REFRESH_TIME')) { ?>
    <meta http-equiv="refresh" content="<?= REFRESH_TIME ?>" />
<?php } ?>
</head>

<body>
    <div id="wrapper" class="template">
<?php require 'includes/header.php' ?>
<?php require 'includes/sidebar.php' ?>

        <div id="content">
            <h1>Pet Cam</h1>

<?php for ($i = 1; $i <= NUM_CAMS; $i++) { ?>
    <?php if (isCamAvailable($i)) { ?>
            <div class="cam-img">
                <a href="<?= getImagePath($i) ?>"><img src="<?= getImagePath($i) ?>" alt="Latest LIVE image from <?= getCamIdentifier($i) ?>" /></a>
                <p><?= getCamIdentifier($i) . ' (' . getCamStatus($i) . ')' ?></p>
            </div>
    <?php } ?>
<?php } ?>

<?php if (defined('REFRESH_TIME')) { ?>
            <p>This page will automatically refresh in <?= ceil(REFRESH_TIME / 60) ?> minute<?= ceil(REFRESH_TIME / 60) == 1 ? "" : "s" ?> in
            order to show a new picture!</p>
<?php } else { ?>
            <p>All cameras appear to be offline--they can go down periodically for various reasons. Please try again later.</p>
<?php } ?>
        </div>

<?php require 'includes/footer.php' ?>
    </div> <!-- end wrapper -->
</body>

</html>
