<?php
namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RedeemPointsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => 'required|integer|min:1',
            'itemNumber' => 'required|string',
        ];
    }
}
