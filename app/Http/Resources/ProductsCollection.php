<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $products = [];

        if (!empty($this->collection)) {
            foreach ($this->collection as $product) {
                $products[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'tags' => $product->tags,
                    'created_at' => Carbon::parse($product->created_at)->format('d/m/Y'),
                    'updated_at' => Carbon::parse($product->updated_at)->format('d/m/Y'),
                ];
            }
        }

        return $products;
    }
}
