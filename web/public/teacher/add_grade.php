<?php
// add grade page
include __DIR__ . '/../init.php';

if (!isset($USER) || ($USER['role'] != 'teacher' && $USER['role'] != 'admin')) {
    header('Location: /login.php');
    die();
}
$return_to = $_GET['return_to'];

$subject_id = $_GET['subject_id'];
$student_id = $_GET['student_id'];
$grade = $_GET['grade'];

$db = DB::getInstance();

$subject = $db->fetchOne("SELECT * FROM subjects WHERE id = ?", [$subject_id]);

if (!$subject) {
    header('Location: /main.php');
    die();
}

$db->execute("INSERT INTO grades (grade, student_id, teacher_id, subject_id) VALUES (?, ?, ?, ?)", [$grade, $student_id, $USER['id'], $subject_id]);

header('Location: ' . $return_to);