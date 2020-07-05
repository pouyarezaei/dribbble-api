<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

abstract class ApiController extends RespondController
{
    /**
     * @return ResourceCollection | Response
     */
    public abstract function getAll();

    /**
     * @param $id int | mixed
     * @return ResourceCollection | Response
     */
    public abstract function getById($id);

    /**
     * @param Request $request
     * @return Response
     */
    public abstract function store(Request $request);

    /**
     * @param Request $request
     * @param $id int | mixed
     * @return Response
     */
    public abstract function updateById(Request $request, $id);

    public abstract function deleteById($id);

}
