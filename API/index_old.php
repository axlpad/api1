<?php

require 'flight/Flight.php';

Flight::route('/', function () {
    echo 'hello world! AXel AXEL';
});

Flight::start();
