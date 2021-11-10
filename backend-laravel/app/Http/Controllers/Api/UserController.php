<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UpdateUser;
use App\RealWorld\Transformers\UserTransformer;

class UserController extends ApiController
{
    /**
     * UserController constructor.
     *
     * @param UserTransformer $transformer
     */
    public function __construct(UserTransformer $transformer)
    {
        $this->transformer = $transformer;

        $this->middleware('auth.api');
    }

    /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->respondWithTransformer(auth()->user());
    }

    /**
     * Update the authenticated user and return the user if successful.
     *
     * @param UpdateUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUser $request)
    {
        $user = auth()->user();

        if ($request->has('user')) {
            $user->username = $request->input('user.username');
            $user->email = $request->input('user.email');
            $user->bio = $request->input('user.bio');
            $user->role_id = $request->input('user.role_id');
            $user->file_id = $request->input('user.file_id');
            $user->password = bcrypt($request->input('user.password'));
            $user->update();
        }

        return $this->respondWithTransformer($user);
    }
}
