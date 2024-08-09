<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\V1\CoinsData;
use App\Models\Coin;

class CoinController extends Controller
{
    public function index()
    {
        $coins = Coin::orderBy('current_price', 'desc')->take(10)->get();
        return view('coins', ['coins' => $coins]);
    }

    public function manualGetData()
    {
        try {
            CoinsData::getCoinsData();
            return response()->json(['status' => 'success', 'message' => 'Cryptocurrency data fetched and stored successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'message' => 'An error occurred while fetching cryptocurrency data.'], 500);
        }
    }
}
