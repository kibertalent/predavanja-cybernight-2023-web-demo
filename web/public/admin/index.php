<?php
include __DIR__ . '/../init.php';
if (!isset($USER) || $USER['role'] != 'admin') {
    header('Location: /login.php');
    die();
}

$db = DB::getInstance();

$users = $db->fetchAll("SELECT * FROM users");

?>

<?php include '../header.php'; ?>
    <h2>Pregled uporabnikov</h2>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <a href="/admin/user.php?id=<?php echo $user['id']; ?>">
                    <?php echo $user['username']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="/logout.php">Odjava</a>
<?php include '../footer.php'; ?>