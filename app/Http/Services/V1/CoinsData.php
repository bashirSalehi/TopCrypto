<?php

namespace App\Http\Services\V1;

use App\Models\Coin;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class CoinsData
{
    public static function getCoinsData()
    {
        $data = self::getDataFromApi();
        self::storeCoinsData($data);
    }

    static function storeCoinsData($data)
    {
        foreach ($data as $item) {
//            try {
                // Prepare the data for insertion
                Coin::updateOrCreate(
                    ['coin_id' => $item['id']],
                    [
                        'symbol' => $item['symbol'],
                        'name' => $item['name'],
                        'image' => $item['image'],
                        'current_price' => $item['current_price'],
                        'market_cap' => $item['market_cap'],
                        'market_cap_rank' => $item['market_cap_rank'],
                        'total_volume' => $item['total_volume'],
                        'high_24h' => $item['high_24h'],
                        'low_24h' => $item['low_24h'],
                        'price_change_24h' => $item['price_change_24h'],
                        'price_change_percentage_24h' => $item['price_change_percentage_24h']
                    ],
                );
//            } catch (\Exception $e) {
//                // Log the exception message
//                Log::error("Error saving coin: {$e->getMessage()}");
//            }
        }
    }

    static function getDataFromApi(): array
    {
        // Initialize the Guzzle HTTP client
        $client = new Client();
        $url = config('coins.service_url');
        $queryParams = ['vs_currency' => config('coins.target_currency')]; // target currency of coins and market data

        try {
            $response = $client->request('GET', $url, [
                'query' => $queryParams
            ]);

            // Check response
            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            } else {
                Log::error('Failed to fetch cryptocurrency data.');
            }
        } catch (\Exception $e) {
            Log::error('An error occurred while fetching cryptocurrency data.', ['exception' => $e->getMessage()]);
        }
        return [];
    }

    static function top10Prices(array $data): array
    {
        // Ensure the data is an array
        if (!is_array($data)) {
            throw new RuntimeException('Input is not an array.');
        }

        // Sort the array by 'current_price' in descending order
        usort($data, function ($a, $b) {
            return $b['current_price'] - $a['current_price'];
        });

        // Extract the top 10 cryptocurrencies
        return array_slice($data, 0, 10);
    }
}
