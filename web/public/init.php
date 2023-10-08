<?php
include __DIR__ . '/../app/init.php';
// if coming on login or register page, do not check for cookie

function error_die($err = null, $page = 'login.php')
{
    if ($err) {
        header('Location: /' . $page . '?err=' . urlencode($err));
    } else {
        header('Location: /' . $page);
    }
    exit;
}

function cookie_auth()
{
    // Check if user cookie is set
    if (!isset($_COOKIE['user'])) {
        return error_die();
    }

    // Try b64 decode cookie
    try {
        $cookie = base64_decode($_COOKIE['user']);
        $cookie = json_decode($cookie, true);
    } catch (Exception $e) {
        return error_die("Cannot decode cookie");
    }

    // Check if cookie is valid
    if (!isset($cookie['username'])) {
        return error_die("Invalid cookie");
    }

    $username = $cookie['username'];

    // Check if user exists
    $db = DB::getInstance();
    $user = $db->fetchOne("SELECT * FROM users WHERE username = '$username'");

    if (!$user) {
        return error_die("User does not exist");
    }

    return $user;
}

$_basename = basename($_SERVER['PHP_SELF']);
$no_redirect = ['login.php', 'register.php'];
if (in_array($_basename, $no_redirect)) {
    return;
}

$USER = cookie_auth();
