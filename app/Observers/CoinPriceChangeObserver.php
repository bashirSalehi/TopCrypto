<?php

namespace App\Observers;

use App\Mail\PriceChanged;
use App\Models\Coin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CoinPriceChangeObserver
{
    /**
     * Handle the Coin "created" event.
     */
    public function created(Coin $coin): void
    {
        //
    }

    /**
     * Handle the Coin "updated" event.
     */
    public function updated(Coin $coin): void
    {
        // Get the original price
        $originalPrice = $coin->getOriginal('current_price');

        // Get the new price
        $newPrice = $coin->current_price;
        if ($originalPrice != 0) {
            $percentageChange = abs(($newPrice - $originalPrice) / $originalPrice) * 100;

            $priceChangeType = $newPrice >= $originalPrice ? 'increase' : 'decrease';

            if ($percentageChange > 10) {
                $emailData = [
                    'coin' => $coin,
                    'priceChangePercentage' => $percentageChange,
                    'priceChangeType' => $priceChangeType,
                ];


                Log::notice("The price of $coin->name has $priceChangeType by $percentageChange %");
                // Send email
                try {
                    Mail::to(config('coins.admin_email'))->send(new PriceChanged($emailData));
                } catch (\Exception $e) {
                    Log::error("email not send. Error: {$e->getMessage()}");
                }
            }
        }
    }

    /**
     * Handle the Coin "deleted" event.
     */
    public function deleted(Coin $coin): void
    {
        //
    }

    /**
     * Handle the Coin "restored" event.
     */
    public function restored(Coin $coin): void
    {
        //
    }

    /**
     * Handle the Coin "force deleted" event.
     */
    public function forceDeleted(Coin $coin): void
    {
        //
    }
}
