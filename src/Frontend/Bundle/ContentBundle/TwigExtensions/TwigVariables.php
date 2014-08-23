<?php

namespace Frontend\Bundle\ContentBundle\TwigExtensions;

class TwigVariables extends \Twig_Extension
{
    private $service_container;

    public function __construct( $service_container)
    {
        $this->service_container = $service_container;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('get_global_variables' , [ $this , 'get_global_variables' ] ) ,
        ];
    }

    public function get_global_variables()
    {
        $categories = $this->service_container->get('courseCategory.repository')->find( ['enabled' => true]);

        return $categories;
    }



    public function getName()
    {
        return 'global';
    }
}