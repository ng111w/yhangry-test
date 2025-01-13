<?php

namespace App\Imports;

use App\Models\Cuisine;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;

class MenuImport
{
    public function import(Array $menus):void
    {
        foreach($menus as $menu) {
            $this->importOrUpdateCuisine($menu['cuisines'][0]);
            $this->importMenu($menu);
        }
    }

    public function importOrUpdateCuisine(array $menu): Cuisine|string
    {
        try {
            return Cuisine::updateOrCreate([
                'id' => $menu['id'],
                'name' => $menu['name'],
            ]);
        }catch (\Exception $exception)
        {
            Log::error($exception->getMessage());
            return $exception->getMessage();
        }
    }


    public function importMenu(array $menu): Menu|string
    {
        try {
            return Menu::create([
                'cuisine_id' => $menu['cuisines'][0]['id'],
                'description' => $menu['description'],
                'display_text' => $menu['display_text'],
                'image' => $menu['image'],
                'thumbnail' => $menu['thumbnail'],
                'is_vegan' => $menu['is_vegan'],
                'is_vegetarian' => $menu['is_vegetarian'],
                'name' => $menu['name'],
                'status' => $menu['status'],
                'groups' => serialize($menu['groups']),
                'price_per_person' => $menu['price_per_person'],
                'min_spend' => $menu['min_spend'],
                'is_seated' => $menu['is_seated'],
                'is_standing' => $menu['is_standing'],
                'is_canape' => $menu['is_canape'],
                'is_mixed_dietary' => $menu['is_mixed_dietary'],
                'is_meal_prep' => $menu['is_meal_prep'],
                'is_halal' => $menu['is_halal'],
                'is_kosher' => $menu['is_kosher'],
                'price_includes' => $menu['price_includes'],
                'highlight' => $menu['highlight'],
                'available' => $menu['available'],
                'number_of_orders' => $menu['number_of_orders'],
                'created_at' => $menu['created_at'],
            ]);
        }
        catch (\Exception $exception){
            Log::error($exception->getMessage());
            return $exception->getMessage();
        }
    }
}
