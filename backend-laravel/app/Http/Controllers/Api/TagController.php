<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use App\RealWorld\Transformers\TagTransformer;
use DB;

class TagController extends ApiController
{
    /**
     * TagController constructor.
     *
     * @param TagTransformer $transformer
     */
    public function __construct(TagTransformer $transformer)
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
        $tags = DB::table('tags')
            ->leftJoin('article_tag', 'tags.id', '=', 'article_tag.tag_id')
            ->select(DB::raw('COUNT(article_tag.tag_id) as counter'), 'tags.name')
            ->groupBy('article_tag.tag_id', 'tags.name')
            ->orderBy('counter', 'desc')
            ->get();

        return $this->respondWithTransformer($tags);
    }
}
