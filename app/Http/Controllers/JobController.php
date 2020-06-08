<?php


namespace App\Http\Controllers;


use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class JobController extends ApiController
{
    public function getJobById($id)
    {
        $job = Job::find($id);

        if (!is_null($job)) {
            return $this->respond($job);
        }
        return $this->respondWithError(['Not found'], 404);
    }

    public function updateJobById(Request $request, $id)
    {
        // TODO should first check remember token and find user id and check user id with job user_id
        $job = Job::find($id);

        if (!is_null($job)) {

            $validate = Validator::make($request->all(), Job::rules());
            if ($validate->errors()->isEmpty()) {
                $job->update($request->all());
                return $this->respond(['updated']);
            }
            return $this->respondWithError($validate->errors(), 422);
        }
        return $this->respondWithError(['Not found'], 404);
    }
}
