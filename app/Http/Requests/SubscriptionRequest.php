<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            'name'      => 'required|string|max:255',
            'phone'     => 'required|string|max:255',
            'email'     => 'required|string|max:255',
            'post_code' => 'required|string|max:255',
            'address'   => 'required|string|max:65535',
            'notes'     => 'required|string|max:65535',
            'started_at' => 'required|date',
            'package_id' => 'required|integer',
            'tier_id'   => 'required|integer',
            'proof'     => 'required|file|mimes:png,jpg'

        ];
    }
}
