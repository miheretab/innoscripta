<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Bill extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'date' => $this->formattedDate,
            'billNumber' => $this->billNumber,
            'amount' => $this->formattedAmount,
            'companyId' => $this->company->id,
            'companyName' => $this->company->name,
            'referenceNr' => $this->company->referenceNr
        ];
    }
}
