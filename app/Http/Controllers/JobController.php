<?php


namespace App\Http\Controllers;


use App\Http\Resources\JobsResource;
use App\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Job
 *
 * Api for job
 */
class JobController extends ApiController
{
    /**
     * @queryParam  page required The page number. Example: 4
     */
    public function getAll()
    {
        // TODO fix page size
        // TODO dont forget redis cache
        return new JobsResource(Job::with('user')->paginate(1));
    }

    /**
     * @param $id int
     * @urlParam  id required The id of the job. Example: 2
     * @return JobsResource|JsonResponse
     */
    public function getById($id)
    {
        $job = Job::getFirstById($id);

        if (!is_null($job)) {
            return new JobsResource($job);
        }
        return $this->respondNotFoundError();
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), Job::rules());
        if ($validate->errors()->isEmpty()) {
            Job::create($request->all());
        } else {
            return $this->respond($validate->failed());
        }
    }

    /**
     * @param Request $request
     * @param $id int
     * @urlParam  id required The id of the job. Example: 2
     * @return JsonResponse
     */
    public function updateById(Request $request, $id)
    {
        // TODO should first check remember token and find user id and check user id with job user_id
        $job = Job::getFirstById($id);
        if (!is_null($job)) {
            $validate = Validator::make($request->all(), Job::rules());
            if ($validate->errors()->isEmpty()) {
                $job->update($request->all());
                return $this->respondSuccess();
            }
            return $this->respondValidateError($validate->errors());
        }
        return $this->respondNotFoundError();
    }


    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }
}
