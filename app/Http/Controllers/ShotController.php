<?php


namespace App\Http\Controllers;


use App\Http\Resources\ShotsResource;
use App\Shot;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class ShotController extends ApiController
{
    public function getShotById($id)
    {
        $shot = Shot::find($id);
        if (!is_null($shot)) {
            return $shot;
        }
        // TODO some error for not founded
    }

    public function updateShotById(Request $request, $id)
    {
        $shot = Shot::find($id);
        if (!is_null($shot)) {
            return $shot->update($request->all());
        }
        // TODO not found error
    }

    public function updateShotTagsById(Request $request, $id)
    {
        $shot = Shot::find($id);


        if (!is_null($shot)) {
            $tag = Tag::whereIn('tag', $request['tags'])->get();
            $shot->tags()->sync($tag);
        }
        // TODO not found error
    }

    public function getAllShots()
    {
        return Cache::remember('shots', 15, function () {
            return new ShotsResource(Shot::with(['user', 'comments', 'images', 'videos', 'gifs', 'tags'])->orderBy('update_at')->paginate(10));
        });

    }

    public function addMedia(Request $request, $id)
    {
        $shot = Shot::find($id);
        $file = $request->file('file');
        $mime = $file->getClientMimeType();
        $fileName = time() . $file->getClientOriginalName();
        switch ($mime) {
            case 'image/gif':
                $shot->gifs()->create(['gif' => '/shots/gif/' . $fileName]);
                $file->move('shots/gif', $fileName);
                break;
            case 'image/png':
            case 'image/jpeg':
                $shot->images()->create(['image' => '/shots/images/' . $fileName]);
                $file->move('shots/image', $fileName);
                break;
            case 'video/mp4':
                $shot->videos()->create(['video' => '/shots/videos/' . $fileName]);
                $file->move('shots/videos', $fileName);
                break;
        }
//        if ($mime == 'image/gif') {
//            $shot->gifs()->create(['gif' => '/shots/gif/' . $fileName]);
//            $file->move('shots/gif', $fileName);
//        } elseif ($mime == 'image/jpeg' || $mime == 'image/png') {
//            $shot->images()->create(['image' => '/shots/images/' . $fileName]);
//            $file->move('shots/image', $fileName);
//
//        } elseif ($mime == 'video/mp4') {
//            $shot->videos()->create(['video' => '/shots/videos/' . $fileName]);
//            $file->move('shots/videos', $fileName);
//
//        } else {
//            // Todo get some error for not supported files
//        }
    }

    public function getCommentByShotId($id)
    {
        $shot = Shot::find($id);
        if (!is_null($shot)) {
            return $shot->comments;
        }
        // TODO some error for not founded
    }

    public function viewss()
    {
        $arr = ['name' => 'payam', 'family' => 'reza'];
        return view('view', $arr);
    }

}
