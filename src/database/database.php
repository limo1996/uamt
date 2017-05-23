<?php
include (__DIR__.'/../intranet/attendance/classes/Absence.php');
include (__DIR__.'/../intranet/attendance/classes/Employee.php');
include (__DIR__.'/../intranet/attendance/classes/EmployeeAbsence.php');


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

    function fetchAisEmployees(){
        $request = $this->conn->prepare("SELECT * FROM ais_emp");
        $request->setFetchMode(PDO::FETCH_CLASS, "Employee");
        return $request->execute() ? $request->fetchAll() : null;
    }

    function fetchEmployees(){
        $request = $this->conn->prepare("SELECT * FROM employees");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute() ? $request->fetchAll() : null;
    }

    function sortEmployeesBy($sortBy){
        $request = $this->conn->prepare("SELECT * FROM `employees` ORDER BY `employees`.`".$sortBy."` ASC");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute() ? $request->fetchAll() : null;
    }

    function sortAndFilterEmployeesBy($sortBy, $filterBy, $keyword){
        $request = $this->conn->prepare("SELECT * FROM employees WHERE ".$filterBy." LIKE '%".$keyword."%' ORDER BY ".$sortBy);
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':keyword' => $keyword)) ? $request->fetchAll() : null;
    }

    function filterEmployeesBy($filterBy, $keyword){
        $request = $this->conn->prepare("SELECT * FROM employees WHERE ".$filterBy." LIKE '%".$keyword."%'");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':filterBy' => $filterBy, ':keyword' => $keyword)) ? $request->fetchAll() : null;
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


    /******************** ATTENDANCE **********************/
    function fetchAllEmployees()
    {
        $request = $this->conn->prepare("SELECT id, firstname, lastname FROM Employee ORDER BY lastname, firstname ASC");
        $request->setFetchMode(PDO::FETCH_CLASS, "Employee");
        return $request->execute() ? $request->fetchAll() : null;
    }

    function fetchEmployee($id)
    {
        $request = $this->conn->prepare("SELECT id, firstname, lastname FROM Employee WHERE id = :id");
        $request->bindValue(":id", $id, PDO::PARAM_INT);
        $request->setFetchMode(PDO::FETCH_CLASS, "Employee");
        return $request->execute() ? $request->fetchAll() : null;
    }

    function fetchAbsences()
    {
        $request = $this->conn->prepare("SELECT id, absencetype FROM Absence");
        $request->setFetchMode(PDO::FETCH_CLASS, "Absence");
        return $request->execute() ? $request->fetchAll() : null;
    }

    function fetchEmployeeAbsence()
    {
        $request = $this->conn->prepare("SELECT idEmployee, idAbsence, date FROM EmployeeAbsence ORDER BY date DESC");
        $request->setFetchMode(PDO::FETCH_CLASS, "EmployeeAbsence");
        return $request->execute() ? $request->fetchAll() : null;
    }

    function fetchEmployeeAbsenceWhere($month, $year, $employeeId)
    {
        $sql = "SELECT idEmployee, idAbsence, date FROM EmployeeAbsence WHERE YEAR(date) = :year AND MONTH(date) = :month AND idEmployee = :employeeId ORDER BY date ASC";
        $request = $this->conn->prepare($sql);
        $request->setFetchMode(PDO::FETCH_CLASS, "EmployeeAbsence");
        return $request->execute(array(':month' => $month, ':year' => $year, ':employeeId' => $employeeId)) ? $request->fetchAll() : null;
    }

    function insertEmployeeAbsence($date, $employeeId, $absenceId)
    {
        $sql = "INSERT INTO EmployeeAbsence(idEmployee, idAbsence, date) VALUES (:employeeId, :absenceId, :date)";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':employeeId' => $employeeId, ':absenceId' => $absenceId, ':date' => $date));
    }

    function deleteEmployeeAbsence($date, $employeeId)
    {
        $sql = "DELETE FROM EmployeeAbsence WHERE idEmployee = :employeeId AND date = :date";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':employeeId' => $employeeId, ':date' => $date));
    }

    function deleteEmployeeAbsenceInterval($dateFrom, $dateTo)
    {
        $sql = "DELETE FROM EmployeeAbsence WHERE date BETWEEN :dateFrom AND :dateTo";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':dateFrom' => $dateFrom, ':dateTo' => $dateTo));
    }

    function fetchPhotos()
    {
        $sql = "SELECT * FROM photos";
        $request = $this->conn->prepare($sql);
        return $request->execute() ? $request->fetchAll() : null;
    }
    function insertNewsletterSubs($email){
        $sql = "INSERT INTO newsletter(Email) VALUES (:email)";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':email' => $email));
    }

    /******************** INTRANET-DOCUMENTS **********************/
    function getTabCategories($tab)
    {
        $request = $this->conn->prepare("SELECT category FROM document WHERE tab = :tab");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':tab' => $tab)) ? $request->fetchAll() : null;
    }

    function getTabDocuments($tab)
    {
        $request = $this->conn->prepare("SELECT * FROM document WHERE tab = :tab");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':tab' => $tab)) ? $request->fetchAll() : null;
    }

    function insertDocument($name, $source, $category, $tab)
    {
        $sql = "INSERT INTO document(NAME, SOURCE, CATEGORY, TAB) VALUES (:name, :source, :category, :tab)";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':name' => $name, ':source' => $source, ':category' => $category, ':tab' => $tab));
    }

}