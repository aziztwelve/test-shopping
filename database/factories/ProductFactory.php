<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $products = [
        'Apple', 'Banana',  'Blackberry',  'Cherimoya',  'Figs', 'Grapefruit', 'Grape', 'Guava', 'Kiwi',  'Kumquat',
        'Lemon', 'Lime',  'Longon Fruit',  'Lychee Nuts',  'Mangoes', 'Melons Bitter', 'Orange Smiles', 'Oro Blanco', 'Papaya Brazilian',  'Passion Fruit',
        ];
    return [
        'name' => $faker->unique()->randomElement($products),
        'image_url' => 'http://womenshour.ru/wp-content/uploads/2017/08/abricos.jpg',
    ];
});
