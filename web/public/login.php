<?php
// Login page
include 'init.php';
# Check if this is post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Check if username is set
    if (!isset($_POST['username']) || empty($_POST['username']) || !isset($_POST['password']) || empty($_POST['password'])) {
        error_die('Manjkajoči podatki');
    }
    # Check if username is valid
    if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
        error_die('Neveljavno ime');
    }
    $username = $_POST['username'];
    $db = DB::getInstance();

    # Check if user exists
    $user = $db->fetchOne("SELECT * FROM users WHERE username = '$username'");
    if (!$user) {
        error_die('Uporabnik ne obstaja');
    }

    # Check password
    if (md5($_POST['password']) != $user['password']) {
        error_die('Napačno geslo');
    }

    // RickRoll
    if ($_POST['username'] == 'JakaNovak' && $_POST['password'] == 'jakanovak2013') {
        // Log rickroll
        $db->execute("INSERT INTO rickrolls (ip) VALUES (?)", [$_SERVER['REMOTE_ADDR']]);

        header('Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        die();
    }

    # Set cookie
    $cookie = [
        'username' => $_POST['username']
    ];
    $cookie = json_encode($cookie);
    $cookie = base64_encode($cookie);
    setcookie('user', $cookie, time() + 60 * 60, '/');
    header('Location: /');
    die();
}
?>
<?php include 'header.php'; ?>
<form action="/login.php" method="post" class="w-25 mx-auto mt-5">
    <div class="form-outline mb-4">
        <label class="form-label" for="username">Uporabniško ime</label>
        <input type="text" name="username" id="username" class="form-control" />
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="password">Geslo</label>
        <input type="password" name="password" id="password" class="form-control" />
    </div>

    <?php if (isset($_GET['err'])) : ?>
        <p class="text-danger"><?php echo $_GET['err']; ?></p>
    <?php endif; ?>

    <button type="submit" class="btn btn-primary">Prijava</button>

    <p class="mt-4">
        Še nimate računa? <a href="/register.php">Registrirajte se</a>
    </p>
</form>



<?php include 'footer.php'; ?>