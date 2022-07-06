<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $result = [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'image' => $this->image
        ];


        if ($request->has('fields')) {
            $optionalFields = explode(',', $request->fields);

            if (in_array('images', $optionalFields)) {
                $result['images'] = $this->images;
            }

            if (in_array('description', $optionalFields)) {
                $result['description'] = $this->description;
            }
        }

        return $result;
    }
}
