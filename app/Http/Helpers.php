<?php

 if (!function_exists('___SERVER')) {
    function ___SERVER($st_var)
    {
        if(isset($_SERVER[$st_var])) {
            return strip_tags( $_SERVER[$st_var] );
        } elseif(isset($_ENV[$st_var])) {
            return strip_tags( $_ENV[$st_var] );
        } elseif(getenv($st_var)) {
            return strip_tags( getenv($st_var) );
        } elseif(function_exists('apache_getenv') && apache_getenv($st_var, true)){
            return strip_tags( apache_getenv($st_var, true) );
        }
        return '';
    }
 }
 if (!function_exists('trim_str')) {
    function trim_str($str)
    {
        return trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $str)));
    }
 }
 if (!function_exists('cats_flatten')) {
    function cats_flatten($data)
    {
        $result = array();
        if (sizeof($data) > 0) {
            foreach ($data as $entry) {
                $result[] = array(
                    'name' => $entry->name,
                    'url' => $entry->url,
                    'target' => $entry->target,
                    'child' => cats_flatten($entry->children)
                );
            }
        }
        return $result;
    }
 }
 if (!function_exists('keywords_filter')) {
    function keywords_filter($str)
    {
        return implode(',', 
            explode(' ', 
            trim(preg_replace('/,+/', ' ', preg_replace('/\s+/', ",",$str)))
        ));
    }
 }
 if (!function_exists('ifisset')) {
    function ifisset(&$str)
    {
        if(isset($str)){
            return $str;
        }
        return '';
    }
 }
 if (!function_exists('isPage')) {
    function isPage($url)
    {
        $purl = parse_url($url);
        if(isset($purl['query']) && is_string($purl['query'])){
            return '?' . $purl['query'];
        }
        return '';
    }
 }
 if (!function_exists('genPassword')) {
    function genPassword($keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ')
    {
         # set the manual password
         $length = 10;
         $str = '';
         $max = mb_strlen($keyspace, '8bit') - 1;
         for ($i = 0; $i < $length; ++$i) {
             $str .= $keyspace[random_int(0, $max)];
         }
         return $str;
    }
 }
 if (!function_exists('filter_html')) {
    function filter_html($str)
    {
        return htmlspecialchars(trim($str), ENT_QUOTES);
    }
 }
 if (!function_exists('__s')) {
    function __s(&$key = null)
    {
        return (null !== $key) ? $key : '';
    }
 }


 //voyager

 if (!function_exists('get_reflection_method')) {
    function get_reflection_method($object, $method)
    {
        $reflectionMethod = new \ReflectionMethod($object, $method);
        $reflectionMethod->setAccessible(true);

        return $reflectionMethod;
    }
}

if (!function_exists('call_protected_method')) {
    function call_protected_method($object, $method, ...$args)
    {
        return get_reflection_method($object, $method)->invoke($object, ...$args);
    }
}

if (!function_exists('get_reflection_property')) {
    function get_reflection_property($object, $property)
    {
        $reflectionProperty = new \ReflectionProperty($object, $property);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty;
    }
}

if (!function_exists('get_protected_property')) {
    function get_protected_property($object, $property)
    {
        return get_reflection_property($object, $property)->getValue($object);
    }
}
if (!function_exists('get_reflection_class')) {
    function get_reflection_class($class)
    {
        $reflection = new \ReflectionClass($class);
        $re = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
        return $re;
    }
}
if (!function_exists('route__')) {
    function route__($name, $id=null, $query=null)
    {
        $exp = explode('.',$name);
        if(isset($exp[1])){
            switch($exp[1]){
                case 'show':
                    if(!$id){
                        throw new Exception('Missing Parameter $id');
                    }
                    return route($name, ['id'=>$id]) . '?~=' . $query;
                    break;
                default:
                    throw new Exception("Match not found $name");
                break;
            }
        }
        throw new Exception("Invalid route name $name");
    }
}
