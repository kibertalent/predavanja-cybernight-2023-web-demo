<?php
include 'init.php';
if (!isset($USER)) {
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

$grades = $db->fetchAll("SELECT * FROM grades WHERE subject_id = ? AND student_id = ?", [$subject_id, $USER['id']]);

?>

<?php include 'header.php'; ?>
<h2 class="text-center">Predmet: <?= $subject['name'] ?></h2>


<?php if (count($grades) == 0) : ?>
    <p>Ni ocen</p>
<?php else : ?>
    <!-- List of grades with timestamps -->
    <table class="table">
        <thead>
            <tr>
                <th>Ocena</th>
                <th>Datum</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grades as $grade) : ?>
                <tr>
                    <td><h2><span class="badge <?= $grade['grade'] < 2 ? 'bg-danger' : 'bg-success' ?>"><?= $grade['grade'] ?></span></h2></td>
                    <td><?= $grade['timestamp'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a class="btn btn-primary" href="/main.php">Nazaj</a>

<?php include 'footer.php'; ?>