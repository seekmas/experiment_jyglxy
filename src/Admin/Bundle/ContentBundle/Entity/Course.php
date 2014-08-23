<?php

namespace Admin\Bundle\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Course
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\Bundle\ContentBundle\Entity\CourseRepository")
 */
class Course
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="CourseCategory")
     * @ORM\JoinColumn(name="category_id" , referencedColumnName="id")
     */
    private $category;

    /**
     *
     * @ORM\Column(name="category_id" , type="integer")
     */
    private $categoryId;

    /**
     * @ORM\Column(name="alias" , type="string" , length=255 , nullable=true)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     *
     * @ORM\OneToMany(targetEntity="Admin\Bundle\ContentBundle\Entity\Play" , mappedBy="course")
     */
    private $play;
    /**
     *
     * @ORM\Column(name="image" , type="string" , length=255 , nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\Column(name="videoPath" , type="string" , length=255 , nullable=true)
     */
    private $videoPath;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Course
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $play
     * @return Course
     */
    public function setPlay($play)
    {
        $this->play = $play;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlay()
    {
        return $this->play;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Course
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $videoPath
     * @return Course
     */
    public function setVideoPath($videoPath)
    {
        $this->videoPath = $videoPath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVideoPath()
    {
        return $this->videoPath;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Course
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $image
     * @return Course
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $category
     * @return Course
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $categoryId
     * @return Course
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }



    public function __toString()
    {
        return $this->getTitle();
    }
}
