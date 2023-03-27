<?php

namespace App;

class Pokedex
{

    public static function getRandomPokemons($amount = 5)
    {
        $pokedex = self::getPokedex();

        if (isset($_COOKIE['pokemonData']) ) {
            $prevPokemons = json_decode($_COOKIE['pokemonData'], true);
            $pokedex = array_filter($pokedex, function ($elem) use ($prevPokemons) {
                return !in_array($elem, $prevPokemons);
            });
        }
        $randomPokemons = [];
        $randomKeys = array_rand($pokedex, $amount);
        foreach ($randomKeys as $key) {
            $randomPokemons[] = $pokedex[$key];
        }

        usort($randomPokemons, function ($a, $b) {
            return strcmp($a['name']['english'], $b['name']['english']);
        });
        return $randomPokemons;
    }

    private static function getPokedex()
    {
        $jsonString = file_get_contents('pokedex.json');
        return json_decode($jsonString, true);
    }

    public static function getPokemonByID($id)
    {
        $pokedex = self::getPokedex();
        $id = (int)$id;
        foreach ($pokedex as $pokemon) {
            if ($pokemon['id'] === $id) {
                return $pokemon;
            }
        }
        return null;
    }

}


