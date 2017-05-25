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

    function fetchAisEmployees()
    {
        $request = $this->conn->prepare("SELECT * FROM ais_emp");
        $request->setFetchMode(PDO::FETCH_CLASS, "Employee");
        return $request->execute() ? $request->fetchAll() : null;
    }

    function fetchEmployees()
    {
        $request = $this->conn->prepare("SELECT * FROM employees");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute() ? $request->fetchAll() : null;
    }

    function sortEmployeesBy($sortBy)
    {
        $request = $this->conn->prepare("SELECT * FROM `employees` ORDER BY `employees`.`" . $sortBy . "` ASC");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute() ? $request->fetchAll() : null;
    }

    function sortAndFilterEmployeesBy($sortBy, $filterBy, $keyword)
    {
        $request = $this->conn->prepare("SELECT * FROM employees WHERE " . $filterBy . " LIKE '%" . $keyword . "%' ORDER BY " . $sortBy);
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':keyword' => $keyword)) ? $request->fetchAll() : null;
    }

    function filterEmployeesBy($filterBy, $keyword)
    {
        $request = $this->conn->prepare("SELECT * FROM employees WHERE " . $filterBy . " LIKE '%" . $keyword . "%'");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':filterBy' => $filterBy, ':keyword' => $keyword)) ? $request->fetchAll() : null;
    }

    function getEmployee($id, $name)
    {
        $request = $this->conn->prepare("SELECT * FROM employees WHERE PHONE = :id AND SECOND_NAME = :name");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':id' => $id, ':name' => $name)) ? $request->fetchAll() : null;
    }

    function getEmployeeByID($id)
    {
        $request = $this->conn->prepare("SELECT * FROM employees WHERE ID = :id");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':id' => $id)) ? $request->fetchAll() : null;
    }

    function insertNewEmployee($name, $surname, $title1, $title2, $ldaplogin, $photo, $room, $phone, $department, $staff_role, $function)
    {
        $sql = "INSERT INTO employees (FIRST_NAME, SECOND_NAME, TITLE1, TITLE2, LDAPLOGIN, PHOTO, ROOM, PHONE, DEPARTMENT, STAFF_ROLE, FUNCTION) VALUES 
                (:name, :surname, :title1, :title2, :ldaplogin, :photo, :room, :phone, :department, :staff_role, :function)";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':name' => $name, ':surname' => $surname, ':title1' => $title1, ':title2' => $title2, ':ldaplogin' => $ldaplogin,
            ':photo' => $photo, ':room' => $room, ':phone' => $phone, ':department' => $department, ':staff_role' => $staff_role, ':function' => $function));
    }

    function updateEmployee($id, $name, $surname, $title1, $title2, $ldaplogin, $photo, $room, $phone, $department, $staff_role, $function)
    {
        $sql = "UPDATE employees SET FIRST_NAME = :name, SECOND_NAME = :surname, TITLE1 = :title1, TITLE2 = :title2, LDAPLOGIN = :ldaplogin, PHOTO = :photo,
                ROOM = :room, PHONE = :phone, DEPARTMENT = :department, STAFF_ROLE = :staff_role, FUNCTION = :function WHERE ID = :id";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':id' => $id, ':name' => $name, ':surname' => $surname, ':title1' => $title1, ':title2' => $title2, ':ldaplogin' => $ldaplogin,
            ':photo' => $photo, ':room' => $room, ':phone' => $phone, ':department' => $department, ':staff_role' => $staff_role, ':function' => $function));
    }

    function getUsrId($surname)
    {
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
    function fetchPropagationVideos()
    {
        $request = $this->conn->prepare("SELECT * FROM video WHERE TYPE='propagácia' LIMIT 2");
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

    /************************* NEWS *********************************/
    function fetchAllNewsByLang($newsLang,$offset,$rec_limit)
    {
        $sql = "SELECT * FROM Aktuality WHERE Lang = :newsLang LIMIT $offset,$rec_limit";
        $request = $this->conn->prepare($sql);
        return $request->execute(array(':newsLang' => $newsLang)) ? $request->fetchAll() : null;
    }
    function fetchAllActiveNewsByLang($newsLang,$offset,$rec_limit,$date)
    {
        $sql = "SELECT * FROM Aktuality WHERE Lang = :newsLang AND Active >= :date LIMIT $offset,$rec_limit";
        $request = $this->conn->prepare($sql);
        return $request->execute(array(':newsLang' => $newsLang,':date'=>$date)) ? $request->fetchAll() : null;
    }
    function insertNewsletterSubs($email, $newsLang)
    {
        $sql = "INSERT INTO newsletter(Email,newsLang) VALUES (:email,:newsLang)";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':email' => $email, ':newsLang' => $newsLang));
    }

    function deleteNewsletterSubs($email,$newsLang)
    {
        $sql = "DELETE FROM newsletter WHERE Email = :email AND newsLang = :newsLang";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':email' => $email,':newsLang'=>$newsLang));
    }

    function fetchSubsByLang($newsLang)
    {
        $request = $this->conn->prepare("SELECT Email FROM newsletter WHERE newsLang= :newsLang");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':newsLang' => $newsLang)) ? $request->fetchAll() : null;
    }

    function getCountOfNews($newsLang)
    {
        $request = $this->conn->prepare("SELECT COUNT(Title) FROM `Aktuality` WHERE Lang= :newsLang");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':newsLang' => $newsLang)) ? $request->fetchAll() : null;
    }
    function getCountOfActiveNews($newsLang,$date)
    {
        $request = $this->conn->prepare("SELECT COUNT(Title) FROM `Aktuality` WHERE Lang= :newsLang AND Active >= :date");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':newsLang' => $newsLang,':date'=>$date)) ? $request->fetchAll() : null;
    }

    /******************** INTRANET-DOCUMENTS **********************/
    function getTabCategories($tab)
    {
        $request = $this->conn->prepare("SELECT category FROM document WHERE tab = :tab GROUP BY category");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':tab' => $tab)) ? $request->fetchAll() : null;
    }

    function getTabDocuments($tab)
    {
        $request = $this->conn->prepare("SELECT * FROM document WHERE tab = :tab");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':tab' => $tab)) ? $request->fetchAll() : null;
    }

    function getDocumentSource($id)
    {
        $request = $this->conn->prepare("SELECT source FROM document WHERE id = :id");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':id' => $id)) ? $request->fetchAll() : null;
    }

    function insertDocument($name, $source, $category, $tab)
    {
        $sql = "INSERT INTO document(NAME, SOURCE, CATEGORY, TAB) VALUES (:name, :source, :category, :tab)";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':name' => $name, ':source' => $source, ':category' => $category, ':tab' => $tab));
    }

    function deleteDocument($id)
    {
        $sql = "DELETE FROM document WHERE id = :id";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':id' => $id));
    }

    function updateDocument($id, $name, $source)
    {
        if (($name == null || $name == '') && ($source == null || $source == ''))
            return;
        if ($name == null || $name == '') {
            $sql = "UPDATE document SET source = :source WHERE id = :id";
            $request = $this->conn->prepare($sql);
            $request->execute(array(':id' => $id, ':source' => $source));
        } else if ($source == null || $source == '') {
            $sql = "UPDATE document SET name = :name WHERE id = :id";
            $request = $this->conn->prepare($sql);
            $request->execute(array(':id' => $id, ':name' => $name));
        } else {
            $sql = "UPDATE document SET name = :name, source = :source WHERE id = :id";
            $request = $this->conn->prepare($sql);
            $request->execute(array(':id' => $id, ':name' => $name, ':source' => $source));
        }
    }

    /******************** INTRANET-PURCHASES **********************/
    function getPurchases()
    {
        $request = $this->conn->prepare("SELECT * FROM purchases");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute() ? $request->fetchAll() : null;
    }

    function updatePurchase($id, $text)
    {
        $sql = "UPDATE purchases SET TEXT = :text WHERE ID = :id";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':id' => $id, ':text' => $text));
    }

    function insertPurchase($text)
    {
        $sql = "INSERT INTO purchases (TEXT) VALUES (:text)";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':text' => $text));
    }

    function deletePurchase($id)
    {
        $sql = "DELETE FROM purchases WHERE id = :id";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':id' => $id));
    }

    /******************** ROLES **********************/
    function getUserRoles($ldap)
    {
        $request = $this->conn->prepare("SELECT roles.ROLE FROM roles JOIN employee_role ON roles.ID = employee_role.ROLE JOIN employees ON employee_role.EMPLOYEE = employees.ID WHERE employees.LDAPLOGIN = :ldap");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        return $request->execute(array(':ldap' => $ldap)) ? $request->fetchAll() : null;
    }

    function deleteUserRoles($user_id)
    {
        $sql = "DELETE FROM employee_role WHERE EMPLOYEE = :user_id";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':user_id' => $user_id));
    }

    function insertUserRoles($user_id, $role_id)
    {
        $sql = "INSERT INTO employee_role (EMPLOYEE, ROLE) VALUES (:user_id, :role_id)";
        $request = $this->conn->prepare($sql);
        $request->execute(array(':user_id' => $user_id, ':role_id' => $role_id));
    }

}