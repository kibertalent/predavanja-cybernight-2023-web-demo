<?php
include __DIR__ . '/vendor/autoload.php';

include __DIR__ . '/DB.php';

function insert_demo_grades($student_id)
{
    $sql = "INSERT INTO `grades` (`grade`, `student_id`, `subject_id`, `teacher_id`, `timestamp`) VALUES
    ('5', '$student_id', 1, 3, '2023-10-08 21:33:37'),
    ('6', '$student_id', 1, 3, '2023-10-08 21:34:01'),
    ('5', '$student_id', 1, 3, '2023-10-08 21:34:08'),
    ('4', '$student_id', 1, 3, '2023-10-08 21:34:11'),
    ('5', '$student_id', 1, 3, '2023-10-08 21:34:13'),
    ('5', '$student_id', 4, 3, '2023-10-08 21:34:31'),
    ('4', '$student_id', 4, 3, '2023-10-08 21:34:35'),
    ('2', '$student_id', 2, 4, '2023-10-08 21:34:58'),
    ('2', '$student_id', 2, 4, '2023-10-08 21:35:03'),
    ('3', '$student_id', 2, 4, '2023-10-08 21:35:08'),
    ('1', '$student_id', 2, 4, '2023-10-08 21:35:10'),
    ('4', '$student_id', 3, 4, '2023-10-08 21:35:19'),
    ('5', '$student_id', 3, 4, '2023-10-08 21:35:22');";

    $db = DB::getInstance();
    $db->execute($sql);
}

function role_map($role)
{
    switch ($role) {
        case 'admin':
            return 'Administrator';
        case 'teacher':
            return 'Učitelj';
        case 'student':
            return 'Učenec';
        default:
            return 'Neznan';
    }
}
