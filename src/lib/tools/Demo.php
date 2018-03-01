<?php
namespace  tools;
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2018/3/1
 * Time: 下午4:06
 */
class Demo
{


    public static function instance()
    {
        static $obj;
        if(empty($obj)){
            $obj = new self();
        }

        return  $obj;
    }


    public function a()
    {
        return '1';
    }

}