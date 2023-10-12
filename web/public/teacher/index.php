<?php
// teacher page - see subjects you teach
include __DIR__ . '/../init.php';
if (!isset($USER) || ($USER['role'] != 'teacher' && $USER['role'] != 'admin')) {
    header('Location: /login.php');
    die();
}

$db = DB::getInstance();

$subjects = $db->fetchAll("SELECT * FROM users_subjects INNER JOIN subjects ON users_subjects.subject_id = subjects.id WHERE user_id = ?", [$USER['id']]);

?>

<?php include '../header.php'; ?>

<p>Pozdravljen, <?php echo $USER['username']; ?>!</p>

<h2>Pregled predmetov</h2>
<ul>
    <?php foreach ($subjects as $subject) : ?>
        <li>
            <a href="/teacher/subject.php?id=<?php echo $subject['subject_id']; ?>">
                <?php echo $subject['name']; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<a href="/logout.php">Odjava</a>
<?php include '../footer.php'; ?>