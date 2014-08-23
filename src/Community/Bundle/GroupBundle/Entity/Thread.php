<?php

namespace Community\Bundle\GroupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Thread
 *
 * @ORM\Table(name="Group_Thread")
 * @ORM\Entity(repositoryClass="Community\Bundle\GroupBundle\Entity\ThreadRepository")
 */
class Thread
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255 , nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\Bundle\ContentBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id" , referencedColumnName="id")
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_featured", type="boolean", nullable=true)
     */
    private $isFeatured;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_hot", type="boolean", nullable=true)
     */
    private $isHot;

    /**
     * @var integer
     *
     * @ORM\Column(name="reply_num", type="integer", nullable=true)
     */
    private $replyNum;

    /**
     * @ORM\ManyToOne(targetEntity="Community\Bundle\GroupBundle\Entity\Group" , inversedBy="thread")
     * @ORM\JoinColumn(name="group_id" , referencedColumnName="id")
     */
    private $group;

    /**
     * @var integer
     *
     * @ORM\Column(name="group_id", type="integer")
     */
    private $groupId;

    /**
     * @ORM\OneToMany(targetEntity="Community\Bundle\GroupBundle\Entity\ReplyThread" , mappedBy="thread")
     */
    private $replyThread;

    /**
     * @ORM\Column(name="is_role_user" , type="boolean")
     */
    private $isRoleUser;


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
     * Set content
     *
     * @param string $content
     * @return Thread
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
     * Set image
     *
     * @param string $image
     * @return Thread
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Thread
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Thread
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Thread
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isFeatured
     *
     * @param boolean $isFeatured
     * @return Thread
     */
    public function setIsFeatured($isFeatured)
    {
        $this->isFeatured = $isFeatured;

        return $this;
    }

    /**
     * Get isFeatured
     *
     * @return boolean 
     */
    public function getIsFeatured()
    {
        return $this->isFeatured;
    }

    /**
     * Set isHot
     *
     * @param boolean $isHot
     * @return Thread
     */
    public function setIsHot($isHot)
    {
        $this->isHot = $isHot;

        return $this;
    }

    /**
     * Get isHot
     *
     * @return boolean 
     */
    public function getIsHot()
    {
        return $this->isHot;
    }

    /**
     * Set replyNum
     *
     * @param integer $replyNum
     * @return Thread
     */
    public function setReplyNum($replyNum)
    {
        $this->replyNum = $replyNum;

        return $this;
    }

    /**
     * Get replyNum
     *
     * @return integer 
     */
    public function getReplyNum()
    {
        return $this->replyNum;
    }

    /**
     * Set groupId
     *
     * @param integer $groupId
     * @return Thread
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * Get groupId
     *
     * @return integer 
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $replyThread
     */
    public function setReplyThread($replyThread)
    {
        $this->replyThread = $replyThread;
    }

    /**
     * @return mixed
     */
    public function getReplyThread()
    {
        return $this->replyThread;
    }

    /**
     * @param mixed $isRoleUser
     */
    public function setIsRoleUser($isRoleUser)
    {
        $this->isRoleUser = $isRoleUser;
    }

    /**
     * @return mixed
     */
    public function getIsRoleUser()
    {
        return $this->isRoleUser;
    }


}
