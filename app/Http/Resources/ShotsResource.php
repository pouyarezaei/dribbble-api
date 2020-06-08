<?php


namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ShotsResource extends ResourceCollection
{
    public function __construct($resource)
    {

        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */

    public function toArray($request)
    {

        return ['data' => $this->collection->transform(function ($shot) {
            return ['title' => $shot->title,
                'description' => $shot->description,
                'user' => $shot->user->name,
                'user_avatar' => $shot->user->avatar_url,
                'comments' => $shot->comments->pluck('body'),
                'images' => $shot->images->pluck('image'),
                'videos' => $shot->images->pluck('video'),
                'gifs' => $shot->images->pluck('gif'),
                'tags' => $shot->tags->pluck('tag')
            ];
        })];
    }
}
