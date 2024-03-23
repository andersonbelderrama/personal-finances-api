<?php

namespace App\Http\Resources;

use App\Enums\DebtPriority;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DebtResource extends JsonResource
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
            'priority' => $this->priority->label(),
            'status' => $this->status->label(),
            'debt_value' => $this->debt_value,
            'negotiated_value' => $this->negotiated_value,
            'paid_value' => $this->paid_value,
            'payment_date' => $this->payment_date,
            'due_date' => $this->due_date,
            'payment_method' => $this->payment_method->label(),
            'installments' => $this->installments,
            'notes' => json_decode($this->notes, true),
            'payments' => new TransactionResource($this->whenLoaded('transactions')),
            'notes' => new NoteResource($this->whenLoaded('notes')),
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),
        ];

    }
}
