<?php

namespace App\Services;

use App\Http\Resources\ConversionResource;
use App\Http\Resources\RateResourceCollection;
use App\Models\Conversion;
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

    public function convert($data)
    {
        if (!isset($data['currency_from'])) {
            throw new \Exception('Currency source is missing!');
}
        if (!isset($data['currency_to'])) {
            throw new \Exception('Currency target is missing!');
        }
        if (!isset($data['value'])) {
            throw new \Exception('Value is missing!');
        }

        $currency = $data['currency_from'] == 'BTC' ? $data['currency_to'] : $data['currency_from'];

        $rate = Rate::where('currency', $currency)->first();

        if (empty($rate)) {
            throw new \Exception('Provided data has incorrect currency!');
        }

        if ($data['currency_from'] == 'BTC') {
            $calculated_rate = round($rate->rate * (1 - self::$commission / 100), 2);

            $converted_value = round($data['value'] * $calculated_rate, 2);
        } else {
            $calculated_rate = round($rate->rate * (1 + self::$commission / 100), 2);

            $converted_value = round($data['value'] / $calculated_rate, 10);
        }

        $conversion = Conversion::create([
            'currency_from' => $data['currency_from'],
            'currency_to' => $data['currency_to'],
            'value' => $data['value'],
            'converted_value' => $converted_value,
            'rate' => $calculated_rate,
        ]);

        return new ConversionResource($conversion);
    }
}
