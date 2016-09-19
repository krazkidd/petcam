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

<!-- /includes/sidebar.php -->
<div id="sidebarMenu">
    <ul>
        <li id="index"><a href="index.php">Home</a></li>
        <li id="about"><a href="about.php">About</a></li>
    </ul>

    <p><a href="http://krazkidd.net">krazkidd.net Home</a></p>

    <ul id="camStatusList">
<?php for ($i = 1; $i <= NUM_CAMS; $i++) { ?>
        <li>
            <div class="status-list-<?= getCamStatus($i) ?>"></div><?= getCamIdentifier($i) . ' (' . getCamStatus($i) . ')' ?>&nbsp;
        </li>
<?php } ?>
    </ul>
</div>
<!-- end /includes/sidebar.php -->

