<?php

namespace Community\Bundle\GroupBundle\FunctionExtension;

class StrExtension
{
    public function simple_replace( $message , array $context = array())
    {
        $replace = array();
        foreach( $context as $key => $value )
        {
            $replace['{' . $key . '}'] = $value;
        }

        return strtr( $message , $replace );
    }
}