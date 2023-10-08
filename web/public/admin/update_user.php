<?php
// update user
include '../init.php';
if (!isset($USER) || $USER['role'] != 'admin') {
    header('Location: /login.php');
    die();
}

$user_id = $_GET['id'];
$update_field = $_GET['update_field'];
$update_value = $_GET['update_value'];

$db = DB::getInstance();

$user = $db->fetchOne("SELECT * FROM users WHERE id = ?", [$user_id]);

if (!$user) {
    header('Location: /admin/index.php');
    die();
}

if ($update_field == 'username') {
    $db->execute("UPDATE users SET username = ? WHERE id = ?", [$update_value, $user_id]);
} else if ($update_field == 'password') {
    $db->execute("UPDATE users SET password = ? WHERE id = ?", [$update_value, $user_id]);
} else if ($update_field == 'role') {
    $db->execute("UPDATE users SET role = ? WHERE id = ?", [$update_value, $user_id]);
}

header('Location: /admin/user.php?id=' . $user_id);
die();