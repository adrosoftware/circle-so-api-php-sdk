<?php

use Http\Discovery\ClassDiscovery;
use Http\Discovery\Strategy\CommonClassesStrategy;

require __DIR__.'/../vendor/autoload.php';

ClassDiscovery::prependStrategy(CommonClassesStrategy::class);