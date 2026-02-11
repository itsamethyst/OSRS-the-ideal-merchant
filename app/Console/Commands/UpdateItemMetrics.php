<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use App\Models\ItemMetric;

class UpdateItemMetrics extends Command
{
    protected $signature = 'osrs:update-metrics';
    protected $description = 'Calculate margin, ROI and percentage for all items';

    public function handle()
    {
        $this->info('Updating item metrics...');

        $items = Item::with('latestPrice')->get();

        $updated = 0;

        foreach ($items as $item) {
            $price = $item->latestPrice;

            if (!$price || $price->low == 0) {
                continue; // skip invalid data
            }

            $margin = $price->high - $price->low;
            $marginPct = ($margin / $price->low) * 100;
            $roi = (($price->high * 0.99 - $price->low) / $price->low) * 100;

            ItemMetric::updateOrCreate(
                ['item_id' => $item->id],
                [
                    'margin' => $margin,
                    'margin_pct' => round($marginPct, 2),
                    'roi' => round($roi, 2),
                    'updated_at' => now(),
                ]
            );

            $updated++;
        }

        $this->info("Updated {$updated} item metrics.");
    }
}