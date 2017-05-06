<?php
include ('Employee.php');

class Database
{
    private $conn = null;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "uamt";
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=UTF8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function fetchEmployees(){
        $request = $this->conn->prepare("SELECT * FROM employees");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute() ? $request->fetchAll() : null;
    }
}