<?php
// Register page
include 'init.php';
# Check if this is post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Check if username is set
    if (!isset($_POST['username']) || empty($_POST['username']) || !isset($_POST['password']) || empty($_POST['password'])) {
        error_die('Manjkajoči podatki', 'register.php');
    }
    # Check if username is valid
    if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
        error_die('Neveljavno ime', 'register.php');
    }
    $username = $_POST['username'];

    $db = DB::getInstance();
    # Check if user exists
    $user = $db->fetchOne("SELECT * FROM users WHERE username = '$username'");
    if ($user) {
        error_die('Uporabnik že obstaja', 'register.php');
    }

    # Create user
    $db->execute("INSERT INTO users (username, password) VALUES (?, ?)", [
        $_POST['username'],
        password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]);

    insert_demo_grades($db->lastInsertId());

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
<form method="post">
    <label for="username">Uporabniško ime</label>
    <input type="text" name="username" id="username">
    <label for="password">Geslo</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Registracija">

    <a href="/login.php">Prijava</a>

    <?php if (isset($_GET['err'])) : ?>
        <p class="error"><?php echo $_GET['err']; ?></p>
    <?php endif; ?>
</form>
<?php include 'footer.php'; ?>