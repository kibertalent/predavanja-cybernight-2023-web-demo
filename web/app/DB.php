<?php

class DB {

    private $conn;
    private function __construct($errMode = PDO::ERRMODE_EXCEPTION) {

        $host = $_ENV["MYSQL_HOST"];
        $dbname = $_ENV["MYSQL_DATABASE"];
        $username = $_ENV["MYSQL_USER"];
        $password = $_ENV["MYSQL_PASSWORD"];
        
        $this->conn = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $username, $password);
        
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, $errMode);
    }

    // Singleton
    private static $instance = null;

    /**
     * Get the singleton instance of this class
     * @return DB
     */
    public static function getInstance() : DB {
        if (!self::$instance) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    // DB methods

    /**
     * Execute a query with positional parameters
     * @param string $sql
     * @param array $params
     * @return PDOStatement
     */
    public function execute($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);        
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Execute a query with named parameters. The $params array should be an associative array with the keys being the parameter names and the values being an array with the keys "value" and "type".
     * @param string $sql
     * @param array $params
     * @return PDOStatement
     */
    public function execute_with_types($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value['value'], $value['type']);
        }
        $stmt->execute();
        return $stmt;
    }

    /**
     * Fetch one row
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function fetchOne($sql, $params = []) {
        $stmt = $this->execute($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch all rows
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function fetchAll($sql, $params = []) {
        $stmt = $this->execute($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Execute multiple queries
     * @param string $sql
     */
    public function multi_execute($sql) {
        $this->conn->exec($sql);
    }



    public function insert($table, $data) {
        $keys = array_keys($data);
        $values = array_values($data);

        $sql = "INSERT INTO $table (" . implode(", ", $keys) . ") VALUES (" . implode(", ", array_fill(0, count($values), "?")) . ")";
        $this->execute($sql, $values);
    }

    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }

}