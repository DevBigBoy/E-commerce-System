<?php

class TestFacde{
    protected static $container  = 'testfacde';

    public static function __callStatic($name, $args){
        $test = new Test();
        $test =  $test->make(self::$container);
    }
}


TestFacde::name();
