<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Carbon\Carbon;

class TagsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $tags = [];

        if (!empty($this->collection)) {
            foreach ($this->collection as $tag) {
                $tags[] = [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'created_at' => Carbon::parse($tag->created_at)->format('d/m/Y'),
                    'updated_at' => Carbon::parse($tag->updated_at)->format('d/m/Y'),
                ];
            }
        }

        return $tags;
    }
}
