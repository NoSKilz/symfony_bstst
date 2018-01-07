<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use App\Controller\LuckyController;
use App\Controller\HomeController;
use App\Controller\SecurityController;
use App\Controller\AjaxController;
use App\Controller\ProductController;

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
$collection->add('login',
                 new Route('/login',
                     ['_controller' => [SecurityController::class, 'login']])
                );
$collection->add('register',
                 new Route('/register',
                     ['_controller' => [SecurityController::class, 'register']])
                );
$collection->add('logout', new Route('/logout'));
$collection->add('loadmore',
                 new Route('/ajax/loadmore',
                     ['_controller' => [AjaxController::class, 'loadMore']])
                );
$collection->add('showgames',
                 new Route('/product/showgame/{platform}/{genre}',
                     ['_controller' => [ProductController::class, 'showgames']])
                );
$collection->add('show',
                 new Route('/product/show/{id}',
                     ['_controller' => [ProductController::class, 'show']])
                );
$collection->add('search',
                 new Route('/product/search/{query}',
                     ['_controller' => [ProductController::class, 'search']])
                );

return $collection;