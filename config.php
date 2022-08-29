<?php
    require "vendor/autoload.php";


    $client = new MongoDB\Client('mongodb://localhost:27017') or die("Error: Cannot create object");
    // echo "Connection to database successfully";
?>