<?php

namespace App\Http\Controllers\Api;

use App\Role;
use App\RealWorld\Transformers\RoleTransformer;

class RoleController extends ApiController
{
    /**
     * RoleController constructor.
     *
     * @param RoleTransformer $transformer
     */
    public function __construct(RoleTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Get all the roles.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $roles = Role::select('id', 'name', 'is_admin')->get();

        return $this->respondWithTransformer($roles);
    }
}