<?php

require_once('../classes/Dog.php');

class Repro extends Dog
{
    protected $insert;

    public function __construct(string $name, string $sex, String $color, String $insert)
    {
        parent::__construct($name, $sex, $color);
        $this->insert = $insert;
    }
    public function getInsert()
    {
        return $this->insert;
    }
};
