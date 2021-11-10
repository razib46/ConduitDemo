<?php

namespace App\Http\Requests\Api;

class DeleteArticle extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $article = $this->route('article');

        return $this->authorizeAdmin() || $article->user_id == auth()->id();
    }
}
