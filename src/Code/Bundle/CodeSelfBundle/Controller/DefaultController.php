<?php

namespace Code\Bundle\CodeSelfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //highlight_file('/home/wwwroot/master.local/src/Code/Bundle/CodeSelfBundle/Controller/DefaultController.php');
        $finder = new Finder();
        $finder->files()->in( array(

                $this->get('kernel')->getRootDir() . '/../app' ,
                $this->get('kernel')->getRootDir() . '/../src' ,
            )
        );

        $finder->filter(function(\SplFileInfo $file){
            $path = $file->getRealpath();

            if( preg_match('/(app\/cache|console)/' , $path ) )
            {
                return false;
            }
        });


        return $this->render('CodeCodeSelfBundle:Default:index.html.twig' , array('finder' => $finder) );
    }
}
