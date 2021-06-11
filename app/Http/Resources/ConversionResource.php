<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $size = $this->currency_from == 'BTC' ? 2 : 10;

        return [
            'currency_from'     => $this->currency_from,
            'currency_to'       => $this->currency_to,
            'value'             => $this->value,
            'converted_value'   => sprintf('%.' . $size . 'f', $this->converted_value),
            'rate'              => (string)$this->rate,
            'created_at'        => (string)strtotime($this->created_at),
        ];
    }
}
