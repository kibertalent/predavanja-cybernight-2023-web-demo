<?php
    include 'config.php';
    # Check if $USER is set
    ?>
<?php include 'header.php'; ?>
    <p>Učenje je lahko zabavno!</p>
    <?php
        if(isset($USER)) {
            echo "<p>Prijavljeni ste kot $USER</p>";
        } else {
            ?>
            <a href="login.php">Prijava</a>
        <?php } ?>
<?php include 'footer.php'; ?>