<?php
require_once(__DIR__ . '/../../database/requestPDO.php');
require_once(__DIR__ . '/../../php/resizer.php');

class News
{
    private $id;
    private $title = '';
    private $description = '';
    private $display = true;
    private $image;
    private $pdo = null;

    public function __construct(
        $title = '',
        $description = '',
        $display = true,
        $image = ''
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->display = $display;
        $this->image = $image;
        $this->pdo = new RequestPDO();
    }

    public function createNews()
    {
        $stmt = $this->pdo->connect()->prepare(createNews());
        $stmt->bindValue(':title', $this->title);
        $stmt->bindValue(':description', $this->description);
        $stmt->bindValue(':display', $this->display);
        $stmt->bindValue(':image', $this->image);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Une erreur est subvenue durant l'enregistrement de cette actualité : " . $e;
        }
    }

    public function fillFromStdClass(stdClass $datas)
    {
        $this->setId($datas->news_id);
        $this->setTitle($datas->title);
        $this->setDescription($datas->description);
        $this->setDisplay($datas->display);
        $this->setImage($datas->image);
    }
    public function fillFromDatabase(int $id)
    {
        $stmt = $this->pdo->connect()->prepare(getNewsFromId());
        $stmt->bindParam(':newsID', $id);
        $stmt->execute();
        $datas = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->fillFromStdClass($datas);
    }
    public function fillFromArray($array)
    {
        $this->setId($array['news_id']);
        $this->setTitle($array['title']);
        $this->setDescription($array['description']);
        $this->setDisplay($array['display']);
        $this->setImage($array['image']);
    }
    public function fillFromForm($post)
    {
        $this->title = $post['title'];
        $this->description = $post['description'];
        $this->display = $post['display'];
        $this->image = $post['image'];
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
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

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
     * Get the value of display
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * Set the value of display
     *
     * @return  self
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}