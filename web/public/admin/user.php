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
<h2 class="text-center mb-5">Urejanje uporabnika <b><?php echo $user['username']; ?></b></h2>

<!-- <form action="/admin/update_user.php" method="post">
    <input type="hidden" name="id" value="<?php echo $user_id; ?>">
    <label for="username">Uporabniško ime</label>
    <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>">
    <label for="password">Geslo</label>
    <input name="password" id="password" value="<?php echo $user['password']; ?>">
    <label for="role">Vloga</label>
    <select name="role" id="role">
        <option value="student" <?php echo $user['role'] == 'student' ? 'selected' : ''; ?>>Učenec</option>
        <option value="teacher" <?php echo $user['role'] == 'teacher' ? 'selected' : ''; ?>>Učitelj</option>
        <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Administrator</option>
    </select>

    <input type="submit" value="Posodobi uporabnika">
</form> -->


<form action="/admin/update_user.php" method="post" >
    <input type="hidden" name="id" value="<?php echo $user_id; ?>">
    <h1 class="h3 mb-3 font-weight-normal">Urejanje uporabnika</h1>
    <label for="username" class="sr-only">Uporabniško ime</label>
    <input type="text" name="username" id="username" class="form-control" placeholder="Uporabniško ime" value="<?php echo $user['username']; ?>">
    <label for="password" class="sr-only">Geslo</label>
    <input name="password" id="password" class="form-control" placeholder="Geslo" value="<?php echo $user['password']; ?>">
    <label for="role" class="sr-only">Vloga</label>
    <select name="role" id="role" class="form-control">
        <option value="student" <?php echo $user['role'] == 'student' ? 'selected' : ''; ?>>Učenec</option>
        <option value="teacher" <?php echo $user['role'] == 'teacher' ? 'selected' : ''; ?>>Učitelj</option>
        <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Administrator</option>
    </select>
    <button class="btn btn-lg btn-primary btn-block my-3" type="submit">Posodobi uporabnika</button>
</form>


<?php
// If admin or teacher
if ($user['role'] == 'admin' || $user['role'] == 'teacher') {
?>

<?php
} else {
?>

<hr class="my-5">


    <h3 class="mt-5">Ocene</h3>

    <?php if ($grades_count == 0) : ?>
        <p class="font-italic">Ni ocen</p>
    <?php else : ?>

        <?php foreach ($grades as $subject_name => $subject_grades) : ?>
            <h4><?php echo $subject_name; ?></h4>
            <?php if (count($subject_grades) == 0) : ?>
                <p class="font-italic">Ni ocen</p>
            <?php else : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ocena</th>
                            <th>Datum</th>
                            <th>Odstrani</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subject_grades as $grade) : ?>
                            <tr>
                                <td><?php echo $grade['grade']; ?></td>
                                <td><?php echo $grade['timestamp']; ?></td>
                                <td><a href="/teacher/delete_grade.php?id=<?php echo $grade['id']; ?>&return_to=/admin/user.php?id=<?php echo $user_id; ?>">Odstrani</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php endforeach; ?>

    <?php endif; ?>

    <!-- Add grade -->
    <!-- <form action="/teacher/add_grade.php" method="get">
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
    </form> -->

    <hr class="my-5">

    <form action="/teacher/add_grade.php" method="get" class="mt-5">
        <input type="hidden" name="return_to" value="/admin/user.php?id=<?php echo $user_id; ?>">
        <h1 class="h3 mb-3 font-weight-normal">Dodaj oceno</h1>
        <label for="student_id" class="sr-only">Učenec</label>
        <select name="student_id" id="student_id" class="form-control">
            <?php foreach ($students as $student) : ?>
                <option value="<?php echo $student['id']; ?>"><?php echo $student['username']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="subject_id" class="sr-only">Predmet</label>
        <select name="subject_id" id="subject_id" class="form-control">
            <?php foreach ($subjects as $subject) : ?>
                <option value="<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="grade" class="sr-only">Ocena</label>
        <input type="number" name="grade" id="grade" class="form-control">
        <button class="btn btn-lg btn-primary btn-block my-3" type="submit">Dodaj oceno</button>
    </form>

<?php } ?>


<a class="btn btn-primary" href="/admin/index.php">Nazaj</a>

<?php include '../footer.php'; ?>