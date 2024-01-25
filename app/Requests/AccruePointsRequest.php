<?php
namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccruePointsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => 'required|integer|min:1',
            'date' => 'required|date',
            'comment' => 'nullable|string',
        ];
    }
}
