<?php
// update user
include '../init.php';
if (!isset($USER) || $USER['role'] != 'admin') {
    header('Location: /login.php');
    die();
}

$user_id = $_POST['id'];

$db = DB::getInstance();

$user = $db->fetchOne("SELECT * FROM users WHERE id = ?", [$user_id]);

if (!$user) {
    header('Location: /admin/index.php');
    die();
}


$db->execute("UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?", [
    $_POST['username'],
    $_POST['password'],
    $_POST['role'],
    $user_id
]);