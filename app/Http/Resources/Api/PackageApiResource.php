<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'is_popular'    => $this->is_popular,
            'thumbnail'     => $this->thumbnail,
            'about'         => $this->about,
            'city'          => new CityApiResource($this->whenLoaded('city')),
            'category'      => new CategoryApiResource($this->whenLoaded('category')),
            'kitchen'       => new KitchenApiResource($this->whenLoaded('kitchen')),
            'photos'        => PhotoApiResource::collection($this->whenLoaded('photos')),
            'bonuses'       => BonusApiResource::collection($this->whenLoaded('testimonials')),
            'tiers'         => TierApiResource::collection($this->whenLoaded('tiers'))
        ];
    }
}
