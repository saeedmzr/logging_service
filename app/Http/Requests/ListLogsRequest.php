<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListLogsRequest extends FormRequest
{


    public function rules()
    {
        return [
            'serviceNames' => 'nullable|array',
            'statusCode' => 'nullable|numeric',
            'startDate' => 'nullable|date_format:d/M/Y H:i:s',
            'endDate' => 'nullable|date_format:d/M/Y H:i:s',
        ];
    }
}
