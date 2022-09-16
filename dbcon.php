<?php

require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;

$factory = (new Factory)
->withServiceAccount('curd-6a999-firebase-adminsdk-v5cs4-bba51c7ee3.json')
->withDatabaseUri('https://curd-6a999-default-rtdb.firebaseio.com/');
$database = $factory->createDatabase();
?>