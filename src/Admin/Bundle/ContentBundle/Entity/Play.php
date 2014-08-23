<?php

namespace Admin\Bundle\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Play
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\Bundle\ContentBundle\Entity\PlayRepository")
 */
class Play
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Course" , inversedBy="play")
     * @ORM\JoinColumn(name="course_id" , referencedColumnName="id" )
     */
    private $course;

    /**
     *
     * @ORM\Column(name="course_id" , type="integer")
     */
    private $courseId;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="mp4File", type="string", length=255 , nullable=true )
     */
    private $mp4File;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255 , nullable=true )
     */
    private $image;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_enabled", type="boolean" , nullable=true )
     */
    private $isEnabled;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer" , nullable=true )
     */
    private $orderId;


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
     * @return Play
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
     * Set content
     *
     * @param string $content
     * @return Play
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
     * Set mp4File
     *
     * @param string $mp4File
     * @return Play
     */
    public function setMp4File($mp4File)
    {
        $this->mp4File = $mp4File;

        return $this;
    }

    /**
     * Get mp4File
     *
     * @return string 
     */
    public function getMp4File()
    {
        return $this->mp4File;
    }

    /**
     * @param string $image
     * @return Play
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Set isEnabled
     *
     * @param boolean $isEnabled
     * @return Play
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return boolean 
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     * @return Play
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $course
     * @return Play
     */
    public function setCourse($course)
    {
        $this->course = $course;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param mixed $courseId
     * @return Play
     */
    public function setCourseId($courseId)
    {
        $this->courseId = $courseId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCourseId()
    {
        return $this->courseId;
    }

    public function __toString()
    {
        return $this->getTitle();
    }

}
