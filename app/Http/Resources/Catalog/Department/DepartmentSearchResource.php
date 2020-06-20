<?php

namespace App\Http\Resources\Catalog\Department;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentSearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code' => $this->id ?? null,
            'label' => $this->name ?? null,
        ];
    }
}
