<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreWastePurchaseRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'supplier_id' => 'required|exists:suppliers,id',
            'payment_status' => 'required|in:paid,unpaid,partial',
            'amount_paid' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'total_weight' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.waste_category_id' => 'required|exists:waste_categories,id',
            'items.*.price_per_kg' => 'required|numeric|min:0',
            'items.*.weight_kg' => 'required|numeric|min:0.1',
            'items.*.subtotal' => 'required|numeric|min:0',
        ];
    }
}
