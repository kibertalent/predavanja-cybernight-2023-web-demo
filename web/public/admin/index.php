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

<h4 class="text-center"><i>Pozdravljen, <?php echo $USER['username']; ?>!</i></h4>



<!-- <h2>Pregled uporabnikov</h2>
<ul id="users">
    <?php foreach ($users as $user) : ?>
        <li>
            <a href="/admin/user.php?id=<?php echo $user['id']; ?>">
                <?php echo $user['username']; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<a href="/logout.php">Odjava</a> -->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Pregled uporabnikov</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Uporabniško ime</th>
                        <th>Vloga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><a href="/admin/user.php?id=<?php echo $user['id']; ?>">
                                    <?php echo $user['username']; ?>
                                </a></td>
                            <td><?php echo $user['role']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <a class="btn btn-danger" href="/logout.php">Odjava</a>
        </div>
    </div>
</div>
<?php include '../footer.php'; ?>