<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ExpenseRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => ['required', 'string'],
            'sum' => ['required', 'integer'],
            'comment' => ['required', 'string'],
        ];
    }
}
