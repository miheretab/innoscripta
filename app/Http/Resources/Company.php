<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Company extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $company = [
            'id' => $this->id,
            'name' => $this->name,
            'amount' => $this->belingsum,
            'address' => [
                'country' => $this->country,
                'state' => $this->state,
                'city' => $this->city,
                'street' => $this->street,
                'code' => $this->code,
            ],
            'bills' => []
        ];

        foreach($this->bills as $bill) {
            $company['bills'][] = [
                'date' => $bill->formattedDate,
                'billNumber' => $bill->billNumber,
                'amount' => $bill->formattedAmount
            ];
        }

        return $company;
    }
}
