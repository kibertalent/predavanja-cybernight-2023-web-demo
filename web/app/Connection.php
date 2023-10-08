<?php


class Connection
{
    static function getConnection()
    {
        $host = $_ENV['MYSQL_HOST'];
        $dbname = $_ENV['MYSQL_DATABASE'];
        $username = $_ENV['MYSQL_USER'];
        $password = $_ENV['MYSQL_PASSWORD'];

        return new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $username, $password);
    }
}
