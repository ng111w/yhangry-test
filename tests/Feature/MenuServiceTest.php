<?php

namespace Tests\Feature;

use App\Imports\MenuImport;
use App\Models\Cuisine;
use Tests\TestCase;

class MenuServiceTest extends TestCase
{
    public function test_it_imports_cuisines()
    {
        $import = new MenuImport();

        $import->importOrUpdateCuisine($this->mockData());
        $cuisine = Cuisine::findOrFail($this->mockData()['id']);

        $this->assertEquals('Italian', $cuisine->name);
    }

    public function test_cuisines_entry_are_unique()
    {
        $import = new MenuImport();

        $import->importOrUpdateCuisine($this->mockData());

        $cuisine = Cuisine::where('name', $this->mockData()['name'])->get();

        $this->assertEquals($this->mockData()['name'], $cuisine->first()->name);
        $this->assertEquals(1, $cuisine->count());
    }

    public function mockData():array
    {
        return [
            'id' => 33,
            'name' => 'Italian'
        ];
    }
}
