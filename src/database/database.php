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

    function getEmployee($id, $name){
        $request = $this->conn->prepare("SELECT * FROM employees WHERE PHONE = :id AND SECOND_NAME = :name");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':id' => $id, ':name' => $name)) ? $request->fetchAll() : null;
    }

    function getUsrId($surname){
        $request = $this->conn->prepare("SELECT AIS_ID FROM ais_emp WHERE SECOND_NAME = :surname");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':surname' => $surname)) ? $request->fetchAll() : null;
    }

    function fetchProjects()
    {
        $request = $this->conn->prepare("SELECT * FROM projects");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute() ? $request->fetchAll() : null;
    }

    function fetchVideos()
    {
        $request = $this->conn->prepare("SELECT * FROM video");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute() ? $request->fetchAll() : null;
    }

    function fetchMedia()
    {
        $request = $this->conn->prepare("SELECT * FROM media");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute() ? $request->fetchAll() : null;
    }
}