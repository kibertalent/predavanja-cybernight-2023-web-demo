<?php
include 'init.php';

if (isset($USER)) {
    header('Location: /main.php');
    die();
} else {
?>
    <?php include 'header.php'; ?>
    <h2 class="text-center">Učenje je lahko zabavno!</h2>
    <?php

    ?>
    <a class="btn btn-primary" href="/login.php">Prijava</a>
<?php } ?>
<?php include 'footer.php'; ?>