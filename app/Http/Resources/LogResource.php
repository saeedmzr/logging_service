<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {

        return [
            'counter' => $this['count'],
        ];
    }

    public function toResponse($request)
    {
        return parent::toResponse($request)->setStatusCode(200);
    }
}
