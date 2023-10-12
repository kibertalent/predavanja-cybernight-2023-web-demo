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

<h4 class="text-center"><i>Pozdravljen, <?php echo $USER['username']; ?>!</i></h4>

<h2>Pregled predmetov</h2>
<table class="table table-striped">
    <?php foreach ($subjects as $subject) : ?>
        <tr>
            <td><?php echo $subject['name']; ?></td>
            <td><a href="/teacher/subject.php?id=<?php echo $subject['subject_id']; ?>">Ocene</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<a class="btn btn-danger" href="/logout.php">Odjava</a>
        
<?php include '../footer.php'; ?>