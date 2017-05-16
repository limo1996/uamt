<?php 

class Employee
{
    protected $ID, $SECOND_NAME, $AIS_ID;

    public function getID()
    {
        return $this->ID;
    }

    public function getSECOND_NAME()
    {
        return $this->SECOND_NAME;
    }

    public function getAIS_ID()
    {
        return $this->AIS_ID;
    }

    public function getName()
    {
        return $this->SECOND_NAME." (".$this->AIS_ID.")";
    }
}

?>