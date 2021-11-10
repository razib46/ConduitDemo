<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use App\RealWorld\Transformers\PopularUserTransformer;
use DB;

class PopularUsersController extends ApiController
{
    /**
     * PopularUsersController constructor.
     *
     * @param PopularUserTransformer $transformer
     */
    public function __construct(PopularUserTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Get all the tags.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tags = DB::table('articles')
            ->leftJoin('users', 'articles.user_id', '=', 'users.id')
            ->select(DB::raw('COUNT(articles.user_id) as counter'), 'users.username')
            ->groupBy('articles.user_id', 'users.username')
            ->take(10)
            ->orderBy('counter', 'desc')
            ->get();

        return $this->respondWithTransformer($tags);
    }
}
