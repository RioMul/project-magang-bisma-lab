<?php

namespace App\Http\Requests\Order\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_method' => [
                'required',
                'in:bank_transfer,credit_card,ewallet,qris',
            ],
        ];
    }
}