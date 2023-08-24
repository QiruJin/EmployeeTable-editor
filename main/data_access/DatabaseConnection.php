<?php

class DatabaseConnection implements DatabaseConnectionInterface {
    private $host = 'localhost';
    private $dbname = 'employee_management';
    private $username = 'root';
    private $password = '';
    private $connection;

    public function getConnection() {
        $this->connection = null;

        try {
            // Create a new PDO connection
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            // Set error handling to exceptions
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // Display connection error message
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->connection;
    }
}
?>