<?php
class Employee
{
    protected $first_name, $second_name, $title1, $title2, $ldaplogin, $photo, $romm, $phone, $department, $staff_role, $function;

    public function getFirstName()
    {
        return $this->id;
    }

    public function getSecondName()
    {
        return $this->state;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function getLon()
    {
        return $this->lon;
    }

    public function getPartOfDay()
    {
        return $this->partOfDay;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }
}