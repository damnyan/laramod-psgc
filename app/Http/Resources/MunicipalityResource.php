<?php

namespace Modules\PSGC\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MunicipalityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'region_code' => $this->region_code,
            'region_name' => $this->region_name,
            'province_code' => $this->province_code,
            'province_name' => $this->province_name,
        ];
    }
}
