<?php
include '../init.php';
if (!isset($USER) || $USER['role'] != 'admin') {
    header('Location: /login.php');
    die();
}

$user_id = $_GET['id'];

$db = DB::getInstance();

$user = $db->fetchOne("SELECT * FROM users WHERE id = ?", [$user_id]);

if (!$user) {
    header('Location: /admin/index.php');
    die();
}

$students = $db->fetchAll("SELECT * FROM users WHERE role = 'student'");

$subjects = $db->fetchAll("SELECT * FROM subjects");

$grades = [];
$grades_count = 0;
foreach ($subjects as $subject) {
    $grades[$subject['name']] = $db->fetchAll("SELECT * FROM grades WHERE subject_id = ? AND student_id = ?", [$subject['id'], $user_id]);
    $grades_count += count($grades[$subject['name']]);
}
?>

<?php include '../header.php'; ?>
<h2><?php echo $user['username']; ?></h2>

<?php
// If admin or teacher
if ($user['role'] == 'admin' || $user['role'] == 'teacher') {
    echo "Uporabnik je " . role_map($user['role']);
    echo "<br>";
    echo "Zanj ni mogoče dodajati ocen.";
    echo "<br>";
    die();
}
?>

<?php if ($grades_count == 0) : ?>
    <p>Ni ocen</p>
<?php else : ?>

    <?php foreach ($grades as $subject_name => $subject_grades) : ?>
        <h3><?php echo $subject_name; ?></h3>
        <?php if (count($subject_grades) == 0) : ?>
            <p>Ni ocen</p>
        <?php else : ?>
            <ul>
                <?php foreach ($subject_grades as $grade) : ?>
                    <li>
                        <b><?= $grade['grade'] ?></b>
                        (<?= $grade['timestamp'] ?>)

                        <a href="/teacher/delete_grade.php?grade_id=<?php echo $grade['id']; ?>&return_to=/admin/user.php?id=<?php echo $user_id; ?>">Izbriši</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endforeach; ?>

<?php endif; ?>

<!-- Add grade -->
<form action="/teacher/add_grade.php" method="get">
    <input type="hidden" name="return_to" value="/admin/user.php?id=<?php echo $user_id; ?>">
    <label for="student_id">Učenec</label>
    <select name="student_id" id="student_id">
        <?php foreach ($students as $student) : ?>
            <option value="<?php echo $student['id']; ?>"><?php echo $student['username']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="subject_id">Predmet</label>
    <select name="subject_id" id="subject_id">
        <?php foreach ($subjects as $subject) : ?>
            <option value="<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="grade">Ocena</label>
    <input type="number" name="grade" id="grade">
    <input type="submit" value="Dodaj oceno">
</form>


<a href="/admin/index.php">Nazaj</a>

<?php include '../footer.php'; ?>