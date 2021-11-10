<?php

namespace App\RealWorld\Filters;

use App\Tag;
use App\User;

class ArticleFilter extends Filter
{
    /**
     * Filter by author username.
     * Get all the articles by the user with given username.
     *
     * @param $username
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function author($username)
    {
        $user = User::whereUsername($username)->first();

        $userId = $user ? $user->id : null;

        return $this->builder->whereUserId($userId);
    }

    /**
     * Filter by favorited username.
     * Get all the articles favorited by the user with given username.
     *
     * @param $username
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function favorited($username)
    {
        $user = User::whereUsername($username)->first();

        $articleIds = $user ? $user->favorites()->pluck('id')->toArray() : [];

        return $this->builder->whereIn('id', $articleIds);
    }

    /**
     * Filter by tag name.
     * Get all the articles tagged by the given tag name.
     *
     * @param $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function tag($name)
    {
        $tag = Tag::whereName($name)->first();

        $articleIds = $tag ? $tag->articles()->pluck('article_id')->toArray() : [];

        return $this->builder->whereIn('id', $articleIds);
    }
    
    /**
     * Filter by most relevant.
     * Get first 3 most rated articles.
     *
     * @param $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function relevant($name)
    {
        $relevantLimit = request()->get('relevantlimit', 3);
        if ($name == 1) {
            return $this->builder->orderBy('favorited_count', 'desc')->orderBy('updated_at', 'desc');
        } else if ($name == 2) {
            $relevants = $this->builder->orderBy('favorited_count', 'desc')->orderBy('updated_at', 'desc')->take(3)->get();
            $skipArticles = [];
            foreach ($relevants as $value) {
                array_push($skipArticles, $value->slug);
            }
            return $this->builder->whereNotIn('slug', $skipArticles);
        } else {
            return $this->builder;
        }
    }
}