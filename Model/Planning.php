<?php

class Planning
{
    private $week;
    private $userEmail;
    private $year;

    public function __construct($week, $userEmail, $year)
    {
        $this->week = $week;
        $this->userEmail = $userEmail;
        $this->year = $year;
    }

    // Getter
    public function getWeek()
    {
        return $this->week;
    }
    public function getUserEmail()
    {
        return $this->userEmail;
    }
    public function getYear()
    {
        return $this->year;
    }

    // Setter
    public function setWeek($week)
    {
        $this->week = $week;
    }
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }
    public function setYear($year)
    {
        $this->year = $year;
    }
}
