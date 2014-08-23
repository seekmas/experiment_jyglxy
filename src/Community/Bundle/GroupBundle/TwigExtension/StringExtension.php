<?php


namespace Community\Bundle\GroupBundle\TwigExtension;


class StringExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('simple_replace' , [ $this , 'simple_replace' ] ) ,
            new \Twig_SimpleFilter('fill_string' , [ $this , 'fill_string' ] ) ,
        ];
    }

    public function simple_replace( $message , array $context = array())
    {
        $replace = array();
        foreach( $context as $key => $value )
        {
            $replace['%' . $key . '%'] = $value;
        }

        return strtr( $message , $replace );
    }

    public function fill_string( $string , $length)
    {
        if( strlen( $string ) < $length )
        {
            return str_pad( $string , 20 , '.' );
        }else
        {
            return $string;
        }

    }


    public function getName()
    {
        return 'replace';
    }

}