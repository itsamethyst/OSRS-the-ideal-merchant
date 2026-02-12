<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Item;
use Carbon\Carbon;
class FlipController extends Controller
{
   

    public function topFlips()
    {
        $cutoff = now()->subHours(2);

        // only get items where there is at least one recent price and ROI > 0
        $items = Item::whereHas('metric', fn($q) => $q->where('roi', '>', 0))
            ->whereHas('Prices', fn($q) => $q->where('high_time', '>=', $cutoff)
                                        ->orWhere('low_time', '>=', $cutoff))
            ->with([
                'metric',
                'Prices' => fn($q) => $q->where('high_time', '>=', $cutoff)
                                        ->orWhere('low_time', '>=', $cutoff)
                                        ->orderByDesc('high_time')
                                        ->orderByDesc('low_time')
                                        ->limit(1) // only the latest relevant price per item
            ])
            // ->limit(50) // top 50 items at most
            ->get()
            ->map(function ($item) {
                $price = $item->Prices->first(); // latest relevant price
                if (!$price || $price->low <= 0) return null;

                $buy = $price->low;
                $sell = $price->high;

                // subtract 2% tax from the sell price
                $net_sell = $sell * 0.98;

                $margin = $net_sell - $buy; // margin after GE tax
                $roi = $buy > 0 ? ($margin / $buy) * 100 : 0; // ROI in %
                $max_qty = $item->limit ?? 0;
                $total_profit = $margin * $max_qty;

                // if the roi is not 4% +, it's not worth flipping
                if ($roi < 4) return null;

                $item->flip_info = [
                    'buy_price' => $buy,
                    'sell_price' => $sell,
                    'margin' => $margin,
                    'roi' => $roi,
                    'max_qty' => $max_qty,
                    'total_profit' => $total_profit,
                ];

            

        

                return $item;
            })
            ->filter()  // remove nulls
            ->sortBy(fn($item) => $item->flip_info['roi'])
            ->values()
            ->all();

        return Inertia::render('Flips/Top', [
            'items' => $items,
        ]);
    }
}