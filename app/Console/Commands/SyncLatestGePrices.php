<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\GePrice;

class SyncLatestGePrices extends Command
{
    protected $signature = 'osrs:sync-ge-prices';
    protected $description = 'Sync latest OSRS GE prices';

    public function handle(): int
    {
        $this->info('Fetching latest GE prices...');

        $response = Http::withHeaders([
            'User-Agent' => 'OSRS-TIM by itsamethyst',
        ])->get('https://prices.runescape.wiki/api/v1/osrs/latest');

        if (! $response->successful()) {
            $this->error('Failed to fetch GE prices');
            return Command::FAILURE;
        }

        $data = $response->json('data');

        // Map items by osrs_id for fast lookup
        $items = Item::all()->keyBy('osrs_id');

        $insertCount = 0;

       foreach ($data as $osrsId => $price) {
            if (!isset($items[$osrsId])) continue;

            if (!isset($price['high']) || !isset($price['low'])) {
                $this->warn("Item {$osrsId} missing price data, skipping...");
                continue;
            }

            GePrice::create([
                'item_id'   => $items[$osrsId]->id,
                'high'      => $price['high'],
                'low'       => $price['low'],
                'high_time' => isset($price['highTime']) ? Carbon::createFromTimestamp($price['highTime']) : now(),
                'low_time'  => isset($price['lowTime'])  ? Carbon::createFromTimestamp($price['lowTime'])  : now(),
                'created_at'=> now(),
            ]);

            $insertCount++;
        }

        $this->info("Inserted {$insertCount} GE price rows.");

        return Command::SUCCESS;
    }
}