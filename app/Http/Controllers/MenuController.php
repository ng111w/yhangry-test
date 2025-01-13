<?php

namespace App\Http\Controllers;

use App\Http\Filters\MenuFilter;
use App\Http\Resources\MenuResource;
use App\Models\Cuisine;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request, MenuFilter $filters)
    {
        $cuisine = Cuisine::withTheName($request->cuisine);

        return MenuResource::collection(
            Menu::whereBelongsTo($cuisine)
                ->liveStatus()
                ->filter($filters)
                ->paginate()
        );
    }
}
