<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' =>(string)$this->id,
            'name' => $this->name,
            'category'=>$this->category,
            'batch_number'=>$this->batch_number,
            "research_status"=>$this->researchStatus ? $this->researchStatus->name : null,
            "manufacturing_date" =>$this->manufacturing_date,
            "expiration_date" => $this->expiration_date,
            "ingredients" => $this->ingredients->map(function ($ingredient) {
                return [
                    "name" => $ingredient->name,
                    "quantity" => $ingredient->pivot->quantity, // Only include 'quantity'
                ];
            }),

        ];
    }
}
