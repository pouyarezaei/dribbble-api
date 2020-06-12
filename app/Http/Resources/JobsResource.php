<?php


namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobsResource extends ResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */

    public function toArray($request)
    {

        return ['data' => $this->collection->transform(function ($job) {
            return [
                'id' => $job->id,
                'organization_name' => $job->organization_name,
                'title' => $job->title,
                'location' => $job->location,
                'description' => $job->description,
                'category' => $job->category,
                'role_type' => $job->role_type,
                'active' => $job->active,
                'url' => $job->url,
                'website' => $job->website,
                'user_username' => $job->user->username,
                'user_avatar' => $job->user->avatar_url,
            ];
        })];
    }
}