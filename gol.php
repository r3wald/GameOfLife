<?php

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Config\FileLocator;
use GameOfLife\GameOfLife;

require __DIR__ . '/vendor/autoload.php';

$configDirectories = array(__DIR__.'/config');
$configLocator = new FileLocator($configDirectories);
$configFile = $configLocator->locate('config.xml', null, false);

$eventDispatcher = new EventDispatcher();


$gol = new GameOfLife;

while(true) {
    $gol->iterate();
}