<?php

namespace Admin\Bundle\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Play
 *
 * @ORM\Table(name="Group_Message")
 * @ORM\Entity(repositoryClass="Admin\Bundle\ContentBundle\Entity\MessageRepository")
 */
class Message
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
     * @ORM\Column(name="message" , type="text")
     */
    private $message;

    /**
     * @ORM\Column(name="is_read" , type="boolean")
     */
    private $isRead;

    /**
     * @ORM\Column(name="created_at" , type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Community\Bundle\GroupBundle\Entity\ReplyThread")
     * @ORM\JoinColumn(name="reply_id" , referencedColumnName="id")
     */
    private $reply;

    /**
     * @ORM\Column(name="reply_id" , type="integer")
     */
    private $replyId;

    /**
     * @ORM\ManyToOne(targetEntity="Community\Bundle\GroupBundle\Entity\Thread")
     * @ORM\JoinColumn(name="thread_id" , referencedColumnName="id")
     */
    private $thread;

    /**
     * @ORM\Column(name="thread_id" , type="integer")
     */
    private $threadId;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\Bundle\ContentBundle\Entity\User")
     * @ORM\JoinColumn(name="to_user_id" , referencedColumnName="id")
     */
    private $toUser;

    /**
     * @ORM\Column(name="to_user_id" , type="integer")
     */
    private $toUserId;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\Bundle\ContentBundle\Entity\User")
     * @ORM\JoinColumn(name="from_user_id" , referencedColumnName="id")
     */
    private $fromUser;

    /**
     * @ORM\Column(name="from_user_id" , type="integer")
     */
    private $fromUserId;

    /**
     * @ORM\Column(name="is_removed" , type="boolean")
     */
    private $isRemoved;


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
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $fromUser
     */
    public function setFromUser($fromUser)
    {
        $this->fromUser = $fromUser;
    }

    /**
     * @return mixed
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * @param mixed $fromUserId
     */
    public function setFromUserId($fromUserId)
    {
        $this->fromUserId = $fromUserId;
    }

    /**
     * @return mixed
     */
    public function getFromUserId()
    {
        return $this->fromUserId;
    }

    /**
     * @param mixed $isRead
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;
    }

    /**
     * @return mixed
     */
    public function getIsRead()
    {
        return $this->isRead;
    }

    /**
     * @param mixed $isRemoved
     */
    public function setIsRemoved($isRemoved)
    {
        $this->isRemoved = $isRemoved;
    }

    /**
     * @return mixed
     */
    public function getIsRemoved()
    {
        return $this->isRemoved;
    }

    /**
     * @param mixed $thread
     */
    public function setThread($thread)
    {
        $this->thread = $thread;
    }

    /**
     * @return mixed
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * @param mixed $threadId
     */
    public function setThreadId($threadId)
    {
        $this->threadId = $threadId;
    }

    /**
     * @return mixed
     */
    public function getThreadId()
    {
        return $this->threadId;
    }

    /**
     * @param mixed $toUser
     */
    public function setToUser($toUser)
    {
        $this->toUser = $toUser;
    }

    /**
     * @return mixed
     */
    public function getToUser()
    {
        return $this->toUser;
    }

    /**
     * @param mixed $toUserId
     */
    public function setToUserId($toUserId)
    {
        $this->toUserId = $toUserId;
    }

    /**
     * @return mixed
     */
    public function getToUserId()
    {
        return $this->toUserId;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $reply
     */
    public function setReply($reply)
    {
        $this->reply = $reply;
    }

    /**
     * @return mixed
     */
    public function getReply()
    {
        return $this->reply;
    }

    /**
     * @param mixed $replyId
     */
    public function setReplyId($replyId)
    {
        $this->replyId = $replyId;
    }

    /**
     * @return mixed
     */
    public function getReplyId()
    {
        return $this->replyId;
    }


}