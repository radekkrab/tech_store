<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BalanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'user_id' => $this->user_id,
            'transaction_id' => $this->transaction_id,
            'transaction' => TransactionResource::make($this->whenLoaded('transaction')),
        ];
    }
}
