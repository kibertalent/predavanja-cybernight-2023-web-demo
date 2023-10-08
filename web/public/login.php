<?php
    include 'config.php';
    # Check if this is post request
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        # Check if username is set
        if(!isset($_POST['username']) || empty($_POST['username']) || !isset($_POST['password']) || empty($_POST['password'])) {
            login_die('Manjkajoči podatki');
        }
        # Check if username is valid
        if(!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
            login_die('Neveljavno ime');
        }
        $username = $_POST['username'];
        if(in_array($username, array_keys($EXISTING_USERS))) {
            login_die('Uporabniško ime že obstaja');
        } else {
            login_die('Neveljavno uporabniško ime');
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
        <input type="submit" value="Prijava">
    </form>
<?php include 'footer.php'; ?>