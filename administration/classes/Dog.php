<?php

class Dog
{
    protected $name;
    protected $sex;
    protected $color;
    protected $mainImgPath;

    public function __construct(String $name, String $sex, String $color, String $mainImgPath)
    {
        $this->name = $name;
        $this->sex = $sex;
        $this->color = $color;
        $this->mainImgPath = $mainImgPath;
    }


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSex()
    {
        return $this->sex;
    }
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    public function getColor()
    {
        return $this->color;
    }
    public function setcolor($color)
    {
        $this->color = $color;
    }
    public function getMainImgPath()
    {
        return $this->mainImgPath;
    }
    public function setMainImgPath($mainImgPath)
    {
        $this->mainImgPath = $mainImgPath;
    }
}
