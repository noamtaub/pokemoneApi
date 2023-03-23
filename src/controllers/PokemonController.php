<?php
namespace App\controllers;
use App\Pokedex;

class PokemonController
{
    public function index()
    {
        return Pokedex::getRandomPokemons();
    }
    public function view($id)
    {
        $pokemon = Pokedex::getPokemonByID($id);

        if (is_null($pokemon)) {
            http_response_code(404);
            return ['message' => 'Pokemon not found'];
        }
        return $pokemon;
    }

}
