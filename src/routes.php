<?php

use App\controllers\PokemonController;

$routes = [
    'GET' => [
        '/pokemon' => ['controller' => PokemonController::class, 'action' => 'index'] ,
        '/pokemon/(\d+)' => ['controller' => PokemonController::class, 'action' => 'view'] ,
    ],
];
