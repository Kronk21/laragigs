<?php

namespace App\Models;

class Listing_not_Eloquent
{
    public static function all()
    {
        return [
            [
                "id" => 1,
                "title" => "Listing One",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni facere neque velit eum recusandae iusto?",
            ],
            [
                "id" => 2,
                "title" => "Listing Two",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni facere neque velit eum recusandae iusto?",
            ],
            [
                "id" => 3,
                "title" => "Listing Three",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni facere neque velit eum recusandae iusto?",
            ],
        ];
    }

    public static function find($id)
    {
        $listings = self::all();

        foreach ($listings as $listing) {
            if ($listing["id"] == $id) {
                return $listing;
            }
        }
    }
}
