<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
        return [
            'name' => 'required|string|max:255|unique:products,name'. ($this->product ? ",".$this->product->id : ''),
            'category' => 'nullable|string',
            'batch_number' => 'required|numeric|unique:products,batch_number'.($this->product ? ",".$this->product->id : ''),
            'research_status_id' => 'nullable|exists:research_statuses,id',
            'manufacturing_date' => 'required|date|before_or_equal:today', // Ensure a valid date in the past or today
            'expiration_date' => 'required|date|after:manufacturing_date', // Ensure a valid date in the past or today
            'ingredients' => 'present|nullable|array',  // Ensure ingredients is an array
            'ingredients.*.id' => 'required|exists:ingredients,id|distinct',  // Validate each ingredient exists
            //'ingredients.*.id' => 'distinct',  // Validate each ingredient exists
            'ingredients.*.quantity' => 'required|integer|min:1',  // Ensure quantity is an integer greater than 0
        
        ];
    }
    public function messages()
{
    return [
        //'ingredients.*.id.distinct' => 'This ingredient already already exists.',
    ];
}
}

     
