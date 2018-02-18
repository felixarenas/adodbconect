<?php

namespace farenas\Tests;

class FunctionGeneral 
{
    public function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function isArray($array,$keyFind)
    {

        if (!is_array($array)) {

            return false;
        }

        $resp = true;

        foreach ($keyFind as $key => $item) {

            if (!array_key_exists($item,$array)) {

                $resp = false;
            }
        }

        return $resp;
    }

    public function isObject($Object, $KeyFind)
    {

        $resp = true;

        foreach ($KeyFind as $key => $item) {

            if (!$Object instanceof $item) {
                
                $resp = false;
            }
        }

        return $resp;
    }
}