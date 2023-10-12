<?php
include 'init.php';
if (!isset($USER)) {
    header('Location: /login.php');
    die();
}

if ($USER['role'] == 'admin') {
    header('Location: /admin/index.php');
} else if ($USER['role'] == 'teacher') {
    header('Location: /teacher/index.php');
}

$db = DB::getInstance();
$subjects = $subjects = $db->fetchAll("SELECT subjects.*, COUNT(grades.id) AS grade_count, AVG(grades.grade) AS average_grade FROM subjects LEFT JOIN grades ON subjects.id = grades.subject_id WHERE grades.student_id = ? GROUP BY subjects.id", [$USER['id']]);

?>

<?php include 'header.php'; ?>

<h4 class="text-center"><i>Pozdravljen, <?php echo $USER['username']; ?>!</i></h4>

<h2 class="text-center">Pregled predmetov</h2>
<table class="table">
    <thead>
        <tr>
            <th>Predmet</th>
            <th>Število ocen</th>
            <th>Povprečna ocena</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($subjects as $subject) : ?>
            <tr>
                <td><a href="/subject.php?id=<?= $subject['id'] ?>"><?= $subject['name'] ?></a></td>
                <td><?= $subject['grade_count'] ?></td>
                <td><?= $subject['average_grade'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Odjava -->
<a class="btn btn-danger" onclick="return confirm('Ali ste prepričani, da se želite odjaviti?')" href="/logout.php">Odjava</a>

<?php include 'footer.php'; ?>