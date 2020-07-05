<?php


namespace App\Http\Controllers;


abstract class RespondController extends Controller
{
    protected function respond($data, $status = 200, $headers = [])
    {
        return response()->json($data, $status, $headers);
    }

    protected function respondNotFoundError()
    {
        return $this->respond(['status' => 404, 'data' => 'Not Found'], 404);
    }

    protected function respondUnauthorized()
    {
        return $this->respond(['status' => 401, 'data' => 'Unauthorized'], 401);
    }

    protected function respondSuccess()
    {
        return $this->respond(['status' => 200, 'data' => 'Success'], 200);
    }

    protected function respondInternalError()
    {
        return $this->respond(['status' => 500, 'data' => 'Internal Error'], 500);
    }

    protected function respondValidateError($data)
    {
        return $this->respond(['status' => 422, 'data' => $data], 500);
    }
}