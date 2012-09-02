<?php
require_once dirname(__FILE__) . '/../vendor/SplClassLoader.php';
$loader = new SplClassLoader('Acne', dirname(__FILE__) . '/../src');
$loader->setNamespaceSeparator('_');
$loader->register();
