<?php
// delete grade
include __DIR__ . '/../init.php';

if (!isset($USER) || ($USER['role'] != 'teacher' && $USER['role'] != 'admin')) {
    header('Location: /login.php?err=Nepravilna vloga');
    die();
}

$return_to = $_GET['return_to'] ?? null;

$grade_id = $_GET['grade_id'] ?? null;

$db = DB::getInstance();

$grade = $db->fetchOne("SELECT * FROM grades WHERE id = ?", [$grade_id]);

if (!$grade) {
    header('Location: /main.php?err=Ocena ne obstaja');
    die();
}

$db->execute("DELETE FROM grades WHERE id = ?", [$grade_id]);

if ($return_to) {
    header('Location: ' . $return_to);
} else {
    header('Location: /main.php');
}