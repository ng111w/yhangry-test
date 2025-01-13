<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cuisines'=>[
                'name' => $this->cuisine->name,
                'slug'  => $this->cuisine->slug,
                'number_of_orders' => $this->number_of_orders,
                'set_menu_count' => "I AM NOT SURE WHAT IS REQUIRED HERE"
                ],

            'SetMenu' =>
            [
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price_per_person,
                'minSpend' => $this->min_spend,
                'is_halal' => $this->is_halal,
                'created_at'   => $this->created_at,
                'thumbnail' => $this->thumbnail,
                'cuisines' =>
                [
                    'id'    => $this->cuisine->id,
                    'name' => $this->cuisine->name
                ]
            ]
        ];

        //return parent::toArray($request);
    }
}
