<?php


namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobsResource extends ResourceCollection
{
    protected $status;

    public function __construct($resource, $status = 200)
    {
        parent::__construct($resource);
        $this->status = $status;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */

    public function toArray($request)
    {

        return ['status' => $this->status,'data' => $this->collection->transform(function ($job) {
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
                'user' => $job->user,

            ];
        })];
    }
}