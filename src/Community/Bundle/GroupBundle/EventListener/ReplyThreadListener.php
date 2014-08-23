<?php

namespace Community\Bundle\GroupBundle\EventListener;

use Admin\Bundle\ContentBundle\Entity\Message;
use Community\Bundle\GroupBundle\Event\ThreadEvent;
use Community\Bundle\GroupBundle\EventAlias;

class ReplyThreadListener
{
    public function onReplySuccess(ThreadEvent $event)
    {

        $container = $event->getContainer();

        $thread = $event->getThread();
        $replyThread = $event->getReply();
        $form = $event->getForm();
        $reply = $form->getData();

        $toUser = $thread->getUser();
        $fromUser = $reply->getUser();
        $messageContent =  EventAlias::Reply;

        $em = $container->get('doctrine')->getManager();
        $message = new Message();
        $em->persist( $message);

        $message->setCreatedAt(new \Datetime());
        $message->setIsRead( false);
        $message->setFromUser( $fromUser );
        $message->setToUser( $toUser );
        $message->setThread( $thread );
        $message->setReply( $replyThread);
        $message->setMessage( $messageContent );
        $message->setIsRemoved( false );

        $em->flush();
    }
}