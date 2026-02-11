<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// 1. Define the wrapper command
Artisan::command('osrs:sync-and-calculate', function () {
    $this->info('Starting sync...');
    $this->call('osrs:sync-ge-prices');
    
    $this->info('Calculating metrics...');
    $this->call('osrs:update-metrics');
    
    $this->info('Done!');
})->purpose('Sync GE prices and then calculate item metrics');

// 2. Schedule it using the Schedule Facade (The Laravel 12 way)
Schedule::command('osrs:sync-and-calculate')->everyFiveMinutes();