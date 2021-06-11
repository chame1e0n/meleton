<?php

namespace App\Services;

use App\Http\Resources\RateResourceCollection;
use App\Models\Rate;
use Spatie\QueryBuilder\Enums\SortDirection;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class to monitor BTC rates.
 *
 * @author Vitalii Zinkov
 */
class BTC
{
    private static $source = 'https://blockchain.info/ticker';

    private static $commission = 2;

    public function __construct()
    {
        $currencies = json_decode(file_get_contents(self::$source), true);

        if (!empty($currencies)) {
            Rate::truncate();

            foreach($currencies as $currency => $rates) {
                Rate::create([
                    'currency' => $currency,
                    'rate' => $rates['last'],
                ]);
            }
        }
    }

    public function rates()
    {
        $rates = QueryBuilder::for(Rate::class)
            ->allowedFilters('currency')
            ->defaultSort('rate')
            ->get();

        return new RateResourceCollection($rates);
    }
}
