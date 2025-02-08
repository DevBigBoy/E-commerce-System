<?php

class Test {
    public function welcome() {
        return 'Hello Crocoit';
    }
}

class App extends Test {
    public function __construct() {
        echo __CLASS__;
    }

    public function welcome() {
        // Call the parent method and add more functionality
        return parent::welcome() . ' and welcome to Laravel!';
    }
}

$app = new App();
echo "\n" . print_r($app->welcome(), true);
