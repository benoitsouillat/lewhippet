<?php

class Dog
{
    protected $name;
    protected $sex;
    protected $color;

    public function __construct(String $name, String $sex, String $color)
    {
        $this->name = $name;
        $this->sex = $sex;
        $this->color = $color;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function getColor()
    {
        return $this->color;
    }
}
