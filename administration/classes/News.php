<?php
require_once(__DIR__ . '/../../database/requestPDO.php');
require_once(__DIR__ . '/../../php/resizer.php');
require_once(__DIR__ . '/../utilities/usefull_functions.php');

class News
{
    private $id = 0;
    private $title = '';
    private $description = '';
    private $display = true;
    private $image;
    private $createdAt = null;
    private $pdo = null;

    public function __construct(
        $title = '',
        $description = '',
        $display = true,
        $image = '/news_img/default.jpg',
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->display = $display;
        $this->image = $image;
        $this->pdo = new RequestPDO();
        $this->createdAt = '';
    }

    public function createNews()
    {
        $this->createdAt = new DateTime('now');
        $this->setCreatedAt($this->createdAt->format('Y-m-d'));
        $stmt = $this->pdo->connect()->prepare(createNews());
        $stmt->bindValue(':title', $this->title);
        $stmt->bindValue(':description', $this->description);
        $stmt->bindValue(':display', $this->display);
        $stmt->bindValue(':image', $this->image);
        $stmt->bindValue(':createdAt', $this->createdAt);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Une erreur est subvenue durant l'enregistrement de cette actualité : " . $e;
        }
    }
    public function updateNews()
    {
        $stmt = $this->pdo->connect()->prepare(updateNews());
        $stmt->bindValue(':newsID', $this->id);
        $stmt->bindValue(':title', $this->title);
        $stmt->bindValue(':description', $this->description);
        $stmt->bindValue(':display', $this->display);
        $stmt->bindValue(':image', $this->image);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Une erreur est subvenue durant la mise à jour de cette actualité : " . $e;
        }
    }
    public function deleteNews()
    {
        $stmt = $this->pdo->connect()->prepare(deleteNews());
        $stmt->bindValue(':newsID', $this->id);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Impossible de supprimer cette actu ! Contactez l'administrateur du site !";
        }
    }

    public function fillFromStdClass(stdClass $datas)
    {
        $this->setId($datas->news_id);
        $this->setTitle($datas->title);
        $this->setDescription($datas->description);
        $this->setDisplay($datas->display);
        $this->setImage($datas->image);
        $this->setCreatedAt($datas->created_at);
    }
    public function fillFromDatabase(int $id)
    {
        $stmt = $this->pdo->connect()->prepare(getNewsFromId());
        $stmt->bindParam(':newsID', $id);
        $stmt->execute();
        $datas = $stmt->fetch(PDO::FETCH_OBJ);
        $this->fillFromStdClass($datas);
    }
    public function fillFromArray($array)
    {
        $this->setId($array['news_id']);
        $this->setTitle($array['title']);
        $this->setDescription($array['description']);
        $this->setDisplay($array['display']);
        $this->setImage($array['news_image']);
        $this->setCreatedAt($array['news_createdAt']);
    }
    public function fillFromForm($post)
    {
        $this->id = $post['news_id'];
        if ($post['news_id'] > 0) {
            $this->fillFromDatabase($post['news_id']);
        }
        $this->title = $post['title'];
        $this->description = $post['description'];
        $this->display = $post['display'];
    }
    public function moveNewsImage($files)
    {
        $file_name = $this->getTitle() . $this->getId();
        if (isset($files['news_image']) && $files['news_image']['name'] != null) {
            $file_tmp = $files['news_image']['tmp_name'];
            $destination_name = replace_reunion_char(replace_accent($file_name));
            $destination_folder = '/news_img/';
            $file_destination = '../../news_img/' . replace_reunion_char(replace_accent($file_name)) . '.jpg';
            move_uploaded_file($file_tmp, $file_destination);
            resizeimage($file_destination, $destination_name, $destination_folder);
            $this->setImage($file_destination);
        }
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

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
