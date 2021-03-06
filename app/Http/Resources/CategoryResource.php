<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
           'category_id'      => $this->id,
           'category_name'    => $this->category_name,
           'image_direction'  => $this->image_direction,
           'image_url'        => $this->image_url,
       ];
    }
}
