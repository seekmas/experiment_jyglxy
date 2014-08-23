<?php
namespace Frontend\Bundle\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    public function getAction( $id)
    {
        $header = array('Content-type' => 'text/xml');

        return new Response('<?xml version="1.0" encoding="UTF-8"?>
<i>
    <d p="1.000,1,25,16777215,1402678032,0,b90b6759,484828099">不能再棒！</d>
</i>
        ' , 200 , $header);
    }

    public function addAction(Request $request )
    {

        if( $this->get('security.context')->getToken()->getUser()->getSalt() == $request->get('salt') )
        {
            echo $request->get('id');
        }


        return new Response();
    }
}