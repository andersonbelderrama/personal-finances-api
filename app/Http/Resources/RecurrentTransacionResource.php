<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecurrentTransacionResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'value' => $this->value,
            'type' => $this->type,
            'is_paid' => $this->is_paid,
            'is_active' => $this->is_active,
            'recurrent_date' => $this->recurrent_date,
            'recurrence_frequency' => $this->recurrence_frequency,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'transactions' => new TransactionResource($this->whenLoaded('transactions')),
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),
        ];
    }
}
