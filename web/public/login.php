<?php
// Login page
include 'init.php';
# Check if this is post request
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        # Check if username is set
        if(!isset($_POST['username']) || empty($_POST['username']) || !isset($_POST['password']) || empty($_POST['password'])) {
            error_die('Manjkajoči podatki');
        }
        # Check if username is valid
        if(!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
            error_die('Neveljavno ime');
        }
        $username = $_POST['username'];
        $db = DB::getInstance();

        # Check if user exists
        $user = $db->fetchOne("SELECT * FROM users WHERE username = '$username'");
        if(!$user) {
            error_die('Uporabnik ne obstaja');
        }

        # Check password
        if(md5($_POST['password']) != $user['password']) {
            error_die('Napačno geslo');
        }

        // RickRoll
        if($_POST['username'] == 'JakaNovak' && $_POST['password'] == 'jakanovak2013') {
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
    <form action="/login.php" method="post">
        <label for="username">Uporabniško ime</label>
        <input type="text" name="username" id="username">

        <label for="password">Geslo</label>
        <input type="password" name="password" id="password">
        
        <input type="submit" value="Prijava">

        <a href="/register.php">Registracija</a>
    </form>

    <?php if(isset($_GET['err'])): ?>
        <p class="error"><?php echo $_GET['err']; ?></p>
    <?php endif; ?>

<?php include 'footer.php'; ?>