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
$subjects = $subjects = $db->fetchAll("SELECT * FROM subjects");

?>

<?php include 'header.php'; ?>

<p>Pozdravljen, <?php echo $USER['username']; ?>!</p>

<h2>Pregled predmetov</h2>
<ul>
    <?php foreach ($subjects as $subject) : ?>
        <li>
            <a href="/subject.php?id=<?php echo $subject['id']; ?>">
                <?php echo $subject['name']; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<a href="/logout.php">Odjava</a>
<?php include 'footer.php'; ?>