<?php
// subject page - see grades for all students
include __DIR__ . '/../init.php';
if (!isset($USER) || ($USER['role'] != 'teacher' && $USER['role'] != 'admin')) {
    header('Location: /login.php');
    die();
}

$subject_id = $_GET['id'];

$db = DB::getInstance();

$subject = $db->fetchOne("SELECT * FROM subjects WHERE id = ?", [$subject_id]);

if (!$subject) {
    header('Location: /main.php');
    die();
}

$grades = $db->fetchAll("SELECT *, grades.id as grade_id FROM grades INNER JOIN users ON grades.student_id = users.id WHERE subject_id = ?", [$subject_id]);

$students = $db->fetchAll("SELECT * FROM users WHERE role = 'student'");
?>

<?php include '../header.php'; ?>
<h2><?php echo $subject['name']; ?></h2>


<?php if (count($grades) == 0) : ?>
    <p>Ni ocen</p>
<?php else : ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ime</th>
                <th>Ocena</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grades as $grade) : ?>
                <tr>
                    <td><?php echo $grade['username']; ?></td>
                    <td><?php echo $grade['grade']; ?></td>
                    <td>
                        <a href="/teacher/delete_grade.php?grade_id=<?php echo $grade['grade_id']; ?>" class="btn btn-danger btn-sm">Izbriši</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<!-- Add grade -->
<!-- <form action="/teacher/add_grade.php" method="get">
    <input type="hidden" name="return_to" value="/teacher/subject.php?id=<?php echo $subject_id; ?>">
    <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
    <label for="student_id">Učenec</label>
    <select name="student_id" id="student_id">
        <?php foreach ($students as $student) : ?>
            <option value="<?php echo $student['id']; ?>"><?php echo $student['username']; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="grade">Ocena</label>
    <input type="number" name="grade" id="grade">
    <input type="submit" value="Dodaj oceno">
</form> -->

<form action="/teacher/add_grade.php" method="get" class="form-inline">
    <input type="hidden" name="return_to" value="/teacher/subject.php?id=<?php echo $subject_id; ?>">
    <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
    <div class="form-group">
        <label for="student_id">Učenec</label>
        <select name="student_id" id="student_id" class="form-control">
            <?php foreach ($students as $student) : ?>
                <option value="<?php echo $student['id']; ?>"><?php echo $student['username']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="grade">Ocena</label>
        <input type="number" name="grade" id="grade" class="form-control">
    </div>
    <input type="submit" value="Dodaj oceno" class="btn btn-primary">
</form>

<a href="/teacher/index.php" class="btn btn-secondary my-5">Nazaj</a>

<?php include '../footer.php'; ?>