<?php


namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
         * @var $statusCode
     */
    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param int $statusCode
     * @param string message
     * @return JsonResponse not found error
     */
    public function respondNotFound($statusCode = 404, $data = "Not Found!")
    {
        return $this->respondWithError($statusCode, $data);
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse validation failed  error
     */
    public function respondNotValid(array $data, $statusCode = 422)
    {
        return $this->respondWithError($data, $statusCode);
    }

    /**
     * @param int $statusCode
     * @param string message
     * @return JsonResponse not found error
     */
    public function respondInternalError($statusCode = 500, $data = "Internal Error!")
    {
        return $this->respondWithError($statusCode, $data);
    }

    /**
     * @param array $data
     * @param array http headers
     * @return JsonResponse data
     */
    public function respond($data, $headers = [])
    {
        return response()->json(['status' => $this->getStatusCode(), 'data' => $data], $this->getStatusCode(), $headers);
    }

    /**
     * @param int $statusCode
     * @param $data
     * @return JsonResponse error
     */
    public function respondWithError($data, $statusCode)
    {
        return $this->setStatusCode($statusCode)->respond($data);
    }
}
