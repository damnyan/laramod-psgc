<?php

namespace Modules\PSGC\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
        ];
    }
}
