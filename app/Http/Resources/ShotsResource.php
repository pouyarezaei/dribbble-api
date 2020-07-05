<?php


namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShotsResource extends JsonResource
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
        return [
            'status' => $this->status,
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'user_username' => $this->user->username,
            'user_avatar' => $this->user->avatar_url,
            'comments' => $this->comments->transform(function ($comment) {
                return ['body' => $comment->body, 'user_username' => $comment->user->username, 'user_avatar' => $comment->user->avatar_url];
            }),
            'tags' => $this->tags

        ];
    }
}
