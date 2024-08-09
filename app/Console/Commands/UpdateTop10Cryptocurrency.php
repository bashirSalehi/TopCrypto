<?php

namespace App\Console\Commands;

use App\Http\Services\V1\CoinsData;
use Illuminate\Console\Command;

class UpdateTop10Cryptocurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-top10-cryptocurrency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will call web service and save top 10 cryptocurrencies';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        CoinsData::getCoinsData();
    }
}
