<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
<nav>
    <ul>
        <li><a href="index.php" <?php if ($currentPage == 'index.php') { echo 'id="here"'; }?>>Home</a></li>
        <li><a href="shifter.php" <?php if ($currentPage == 'shifter.php') { echo 'id="here"'; }?>>Shifter</a></li>
        <li><a href="reporter.php" <?php if ($currentPage == 'reporter.php') { echo 'id="here"'; }?>>Reporter</a></li>
        <li><a href="contact.php" <?php if ($currentPage == 'contact.php') { echo 'id="here"'; }?>>Contact</a></li>
    </ul>
</nav>
