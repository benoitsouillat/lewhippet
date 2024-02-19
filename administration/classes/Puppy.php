<?php

include_once(__DIR__ . '/Dog.php');
include_once(__DIR__ . '/Litter.php');
include_once(__DIR__ . '/../sql/puppies_request.php');
// require_once(__DIR__ . '/../../database/requestPDO.php');

class Puppy extends Dog
{

    private $id;
    private ?Litter $litter = null;
    private $breeder = ' de la Romance des Damoiseaux ';
    private $description = '';
    private $available = '';
    private $position = 0;
    private $enable = false;
    // private ?RequestPDO $pdo = null;

    public function __construct(
        string $name = '',
        string $sex = '',
        string $color = '',
        string $mainImgPath = '',
        string $description = '',
        string $available = '',
        int $position = 0,
        bool $enable = false,
        Litter $litter = null,
    ) {
        $this->name = $name;
        $this->sex = $sex;
        $this->color = $color;
        $this->mainImgPath = $mainImgPath;
        $this->available = $available;
        $this->description = $description;
        $this->position = $position;
        $this->enable = $enable;
        $this->litter = $litter;
        $this->breeder = ' de la Romance des Damoiseaux ';
        // $this->pdo = new RequestPDO();
    }

    public function fillFromStdClass(stdClass $data, $conn)
    {
        $this->setId($data->id);
        $this->setName($data->name);
        $this->setSex($data->sex);
        $this->setColor($data->color);
        $this->setMainImgPath($data->main_img_path);
        $this->setAvailable($data->available);
        $this->setDescription($data->description);
        $this->setPosition($data->position);
        $litter = new Litter;
        $litter->fetchFromDatabase($data->Litter);
        $this->setLitter($litter);
        $this->setEnable($data->enable);
    }

    /**
     * Get the value of litter
     */
    public function getLitter()
    {
        return $this->litter;
    }

    /**
     * Set the value of litter
     *
     * @return  self
     */
    public function setLitter($litter)
    {
        $this->litter = $litter;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of sex
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set the value of sex
     *
     * @return  self
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get the value of color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get the value of mainImgPath
     */
    public function getMainImgPath()
    {
        return $this->mainImgPath;
    }

    /**
     * Set the value of mainImgPath
     *
     * @return  self
     */
    public function setMainImgPath($mainImgPath)
    {
        $this->mainImgPath = $mainImgPath;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set the value of id
     *
     * @return  self
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of available
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Set the value of available
     *
     * @return  self
     */
    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }

    /**
     * Get the value of position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the value of position
     *
     * @return  self
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get the value of enable
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set the value of enable
     *
     * @return  self
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }
}
