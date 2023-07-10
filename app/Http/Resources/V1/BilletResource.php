<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BilletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code_billet' => $this->code_billet,
            'spectacle_id' => $this->spectacle_id,
            'utilisateur_id' => $this->utilisateur_id,
            'price'=> $this->price,
            'quantity' => $this->quantity,
            'is_reserved' => $this->is_reserved,
        ];
    }
}
