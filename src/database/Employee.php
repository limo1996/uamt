<?php
class Employee
{
    protected $first_name, $second_name, $title1, $title2, $ldaplogin, $photo, $room, $phone, $department, $staff_role, $function;

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getSecondName()
    {
        return $this->second_name;
    }

    public function getTitle1()
    {
        return $this->title1;
    }

    public function getTitle2()
    {
        return $this->title2;
    }

    public function getLdapLogin()
    {
        return $this->ldaplogin;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function getRoom()
    {
        return $this->room;
    }

    public function getPhone()
    {
        return $this->phone;
    }
    public function getDepartment()
    {
        return $this->department;
    }
    public function getStaffRole()
    {
        return $this->staff_role;
    }
    public function getFunction()
    {
        return $this->function;
    }
}