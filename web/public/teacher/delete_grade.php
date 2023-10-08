<?php
// delete grade
include __DIR__ . '/../init.php';

if (!isset($USER) || ($USER['role'] != 'teacher' && $USER['role'] != 'admin')) {
    header('Location: /login.php');
    die();
}

$return_to = $_GET['return_to'];

$grade_id = $_GET['grade_id'];

$db = DB::getInstance();

$grade = $db->fetchOne("SELECT * FROM grades WHERE id = ?", [$grade_id]);

if (!$grade) {
    header('Location: /main.php');
    die();
}

$db->execute("DELETE FROM grades WHERE id = ?", [$grade_id]);

header('Location: ' . $return_to);