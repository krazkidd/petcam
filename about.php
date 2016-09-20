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

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">

<head>
    <title>Pet Cam - About</title>

    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <link rel="icon" type="image/png" href="images/dog13.png" />
    <link rel="stylesheet" href="styles/style1.css" type="text/css" media="screen,print" />
</head>

<body>
    <div id="wrapper" class="template">
<?php require 'includes/header.php' ?>
<?php require 'includes/sidebar.php' ?>

        <div id="content">
            <h1 class="context">Pet Cam</h1>

            <h1>About This Site</h1>

            <div>
                <p>There are four components to make this site work: A USB
                camera, <a href="https://motion-project.github.io/">surveillance
                software</a>, an upload script, and this website/server.</p>

                <p>The source form of this site is made available to you via
                the GNU Affero General Public License version 3. You may copy,
                modify, use, and redistribute versions of this site under certain
                terms. The files are available on
                <a href="https://github.com/krazkidd/petcam">Github</a>.</p>
            </div>
        </div>

<?php require 'includes/footer.php' ?>
    </div> <!-- end wrapper -->
</body>

</html>
