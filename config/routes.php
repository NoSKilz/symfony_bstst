<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use App\Controller\LuckyController;
use App\Controller\HomeController;

$collection = new RouteCollection();
$collection->add('lucky_number', 
                 new Route('/lucky/number/{max}', 
                 ['_controller' => [LuckyController::class, 'number'],
                  'max'         => '100'],
                 ['max' => '\d+'])
                );
$collection->add('home',
                 new Route('/',
                 ['_controller' => [HomeController::class, 'default']])
                );
return $collection;