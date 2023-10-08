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
<h2><?php echo $subject['name']; ?></h2>


<?php if (count($grades) == 0) : ?>
    <p>Ni ocen</p>
<?php else : ?>
    <ul>
        <?php foreach ($grades as $grade) : ?>
            <li>
                <b><?= $grade['grade'] ?></b>
                (<?= $grade['timestamp'] ?>)
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<a href="/main.php">Nazaj</a>
<?php include 'footer.php'; ?>