<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\RealWorld\Transformers\CategoryTransformer;

class CategoryController extends ApiController
{
    /**
     * CategoryController constructor.
     *
     * @param CategoryTransformer $transformer
     */
    public function __construct(CategoryTransformer $transformer)
    {
        $this->transformer = $transformer;

        $this->middleware('auth.api');
    }

    /**
     * Get all the roles.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::select('id', 'name', 'slug', 'pinned')->get();

        return $this->respondWithTransformer($categories);
    }
}