<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Item;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function index()
    {
        // $items = $this->fetchAllItems();

        // get items from the database
        $items = Item::all();

        // dd($items);

        

        return Inertia::render('Items/Index', [
            'items' => $items,
        ]);
    }

    public function show($id)
    {
        //
    }

    private function fetchAllItems()
    {
        $response = Http::withHeaders([
            'User-Agent' => 'OSRS-TIM-App/1.0 (by Shadowline)',
        ])->get('https://prices.runescape.wiki/api/v1/osrs/mapping');

        return $response->json();
    }

    public function syncAllItems()
    {
        $itemsData = $this->fetchAllItems();
        
        foreach ($itemsData as $itemData) {
            Item::updateOrCreate(
                ['osrs_id' => $itemData['id']],
                [
                    'name' => $itemData['name'] ?? 'Unknown Item',
                    'value' => $itemData['value'] ?? null,
                    'highalch' => $itemData['highalch'] ?? null,
                    'lowalch' => $itemData['lowalch'] ?? null,
                    'limit' => $itemData['limit'] ?? null,
                    'members' => $itemData['members'] ?? false,
                    'examine' => $itemData['examine'] ?? '',
                    'icon' => $itemData['icon'] ?? null,
                ]
            );
        }

        return redirect()->route('items.index')->with('success', 'Items synchronized successfully.');
    }
}
