<?php


namespace App\Http\Controllers;


use App\Http\Resources\ShotsResource;
use App\Repositories\ShotRepository\ShotRepositoryInterface;
use App\Shot;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @group Shots
 *
 *  Api for shots
 */
class ShotController extends ApiController
{
    protected $shotRepository;

    public function __construct(ShotRepositoryInterface $shotRepository)
    {
        $this->shotRepository = $shotRepository;
    }

    /**
     * @method Get
     * @queryParam  page required The page number. Example: 4
     */
    public function getAll()
    {
        // TODO fix page size
        // TODO dont forget redis cache
        return ShotsResource::collection($this->shotRepository->allWithPages());
    }

    /**
     * @method Get
     * @param int shot_id $id
     * @urlParam  id required The id of the shot. Example: 1
     * @return \Illuminate\Http\JsonResponse|JsonResource
     */
    public function getById($id)
    {
        $shot = $this->shotRepository->find($id);
        if (!is_null($shot)) {

            return new ShotsResource($shot);
        }

        return $this->respondNotFoundError();

    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), Shot::rules());
        if (!$validate->fails()) {
            $this->shotRepository->store(
                [
                    'title' => $request->input('title'),
                    'description' => $request->input('description')
                ]
            );
            return $this->respondSuccess();
        }
        return $this->respondValidateError($validate->errors());
    }

    /**
     * @method Put
     * @param Request $request
     * @param int shot_id $id
     * @urlParam  id required The id of the shot. Example: 1
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateById(Request $request, $id)
    {
        $shot = $this->shotRepository->find($id);
        $user = Auth::user();
        if (!is_null($shot) && !is_null($user)) {
            if ($shot->user_id == $user->id) {
                $shot->update(request()->all());
                return $this->respondSuccess();
            }
            return $this->respondUnauthorized();
        }
        return $this->respondNotFoundError();
    }

    /**
     * @method Delete
     * @param int shot_id $id
     * @return \Illuminate\Http\JsonResponse
     * @urlParam  id required The id of the shot. Example: 1
     */
    public function deleteById($id)
    {
        $shot = $this->shotRepository->find($id);
        $user = Auth::user();
        if (!is_null($shot) && !is_null($user)) {
            if ($shot->user_id == $user->id) {
                $this->shotRepository->delete($id);
                return $this->respondSuccess();
            }
            return $this->respondUnauthorized();
        }
        return $this->respondNotFoundError();
    }

    /**
     * @param Request $request
     * @param int shot_id $id
     * @urlParam  id required The id of the shot. Example: 1
     */
    public function updateShotTagsById(Request $request, $id)
    {
        // TODO Updating a shot requires the user to be authenticated with the upload scope.
        // TODO The authenticated user must also own the shot.
        // TODO not found error

        $shot = Shot::find($id);
        if (!is_null($shot)) {
            $tag = Tag::whereIn('tag', $request['tags'])->get();
            $shot->tags()->sync($tag);
        }
    }

    /**
     * @param Request $request
     * @param int shot_id $id
     * @urlParam  id required The id of the shot. Example: 1
     */
    public function addMedia(Request $request, $id)
    {
        // TODO Updating a shot requires the user to be authenticated with the upload scope.
        // TODO The authenticated user must also own the shot.
        // TODO check not found shot
        // TODO file not supports error
        // TODO file not exist error

        if ($request->hasFile('file')) {
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
                default:
            }
        }
    }

    /**
     * @param int shot_id $id
     * @urlParam  id required The id of the shot. Example: 1
     * @return
     */
    public function getCommentByShotId($id)
    {
        // TODO not found error

        $shot = Shot::find($id);
        if (!is_null($shot)) {
            return $shot->comments;
        }
    }


}
