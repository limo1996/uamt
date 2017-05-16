<?php 

class EmployeeAbsence
{
    protected $idEmployee, $idAbsence, $date;

    /*public function __construct($idEmployee, $idAbsence, $date)
    {
        $this->idEmployee = $idEmployee;
        $this->idAbsence = $idAbsence;
        $this->date = $date;
    }*/

    public function __construct(){}

    public function getIdEmployee()
    {
        return $this->idEmployee;
    }

    public function getIdAbsence()
    {
        return $this->idAbsence;
    }

    public function getDate()
    {
        return $this->date;
    }
}
?>