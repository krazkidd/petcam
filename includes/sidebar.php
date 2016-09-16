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
            <div class="status-list-<?= isCamOnline($i) ? 'on' : 'off' ?>line"></div> <?= getCamIdentifier($i) . ' (' . getCamStatus($i) . ')' ?>
        </li>
<?php } ?>
    </ul>
</div>
<!-- end /includes/sidebar.php -->

