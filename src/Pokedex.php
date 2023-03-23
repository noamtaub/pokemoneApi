<?php

namespace App;

class Pokedex
{
    public static function getRandomPokemons($amount = 5)
    {
        $pokedex = self::getPokedex();
        $randomKeys = array_rand($pokedex, $amount);
        $randomItems = [];
        foreach ($randomKeys as $key) {
            $randomItems[] = $pokedex[$key];
        }
        return $randomItems;
    }

    private static function getPokedex()
    {
        $jsonString = file_get_contents('pokedex.json');
        return json_decode($jsonString, true);
    }

    public static function getPokemonByID($id)
    {
        $pokedex = self::getPokedex();
        $id = (int) $id;
        foreach ($pokedex as $pokemon) {
            if($pokemon['id'] === $id){
                return $pokemon;
            }
        }
        return null;
    }

}
