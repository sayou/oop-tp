<?php

const DEFAULT_APP = "frontend";

if(!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;

require __DIR__.'/../lib/OCFram/SplClassLoader.php';

$OCFramLoader = new SplClassLoader('OCFram', __DIR__.'/../lib');
$OCFramLoader->register();

//$appLoader = new 

?>