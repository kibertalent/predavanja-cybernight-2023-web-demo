<?php
include 'init.php';

if (!isset($USER)) {
    header('Location: /login.php');
    die();
}

// unset cookie
setcookie('user', '', time() - 3600, '/');
header('Location: /');
