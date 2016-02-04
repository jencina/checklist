<?php
/* 
 * To use the needed PHP 5.3 functions in a PHP 5.2 environment
 * 
 */
// as of PHP 5.3.0 array_replace_recursive() does the work for us
if (function_exists('array_replace_recursive'))
{
    return call_user_func_array('array_replace_recursive', func_get_args());
}
if (!function_exists('array_replace_recursive'))
{
    function array_replace_recursive($array, $array1)
    {
        function recurse($array, $array1)
        {
            foreach ($array1 as $key => $value)
            {
                // create new key in $array, if it is empty or not an array
                if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key])))
                {
                    $array[$key] = array();
                }

                // overwrite the value in the base array
                if (is_array($value))
                {
                    $value = recurse($array[$key], $value);
                }
                $array[$key] = $value;
            }
            return $array;
        }

        // handle the arguments, merge one by one
        $args = func_get_args();
        $array = $args[0];
        if (!is_array($array))
        {
            return $array;
        }
        for ($i = 1; $i < count($args); $i++)
        {
            if (is_array($args[$i]))
            {
                $array = recurse($array, $args[$i]);
            }
        }
        return $array;
    }
}
?>