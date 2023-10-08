<?php
    // Path: config.php
    // if coming on login or register page, do not check for cookie
    include __DIR__ .'../app/init.php';

    $SQL_CONN = Connection::getConnection();

    function login_die($err=null){
        global $_basename;
        if($_basename == 'index.php') {
            return;
        }
        if($err) {
            header('Location: /login.php?err=' . $err);
        } else {
            header('Location: /login.php');
        }
        die();
    }
    
    function cookie_auth(){
        global $SQL_CONN;

        // Check if user cookie is set
        if(!isset($_COOKIE['user'])) {
            login_die();
        }

        // Try b64 decode cookie
        try{
            $cookie = base64_decode($_COOKIE['user']);
            $cookie = json_decode($cookie, true);
        }catch(Exception $e){
            login_die("Cannot decode cookie");
        }

        // Check if cookie is valid
        if(!isset($cookie['username'])){
            login_die("Invalid cookie");
        }

        $username = $cookie['username'];

        // Check if user exists
        $stmt = $SQL_CONN->prepare("SELECT id FROM users WHERE username = ". $username ." LIMIT 1");
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$user) {
            login_die("User does not exist");
        }

        return $username;
    }

    $_basename = basename($_SERVER['PHP_SELF']);
    $no_redirect = ['login.php', 'register.php'];
    if(in_array($_basename, $no_redirect)) {
        return;
    }

    $USER = cookie_auth();
