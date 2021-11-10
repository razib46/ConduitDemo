<?php

namespace App\RealWorld\Transformers;

class ArticleTransformer extends Transformer
{
    protected $resourceName = 'article';

    public function transform($data)
    {
        $category = [];
        if ($data['category']) {
            $category = [
                'name'       => $data['category']['name'],
                'slug'       => $data['category']['slug'],
                'pinned'     => $data['category']['pinned'],
            ];
        }

        return [
            'slug'              => $data['slug'],
            'title'             => $data['title'],
            'description'       => $data['description'],
            'body'              => $data['body'],
            'tagList'           => $data['tagList'],
            'createdAt'         => $data['created_at']->toAtomString(),
            'updatedAt'         => $data['updated_at']->toAtomString(),
            'favorited'         => $data['favorited'],
            'favoritesCount'    => $data['favoritesCount'],
            'category_id'       => $data['category_id'],
            'category'          => $category,
            'author' => [
                'username'  => $data['user']['username'],
                'bio'       => $data['user']['bio'],
                'image'     => $data['user']['image'],
                'following' => $data['user']['following'],
                'role'      => $this->getRole($data['user']['role']),
                'file'      => $this->getFile($data['user']['file'])
            ]
        ];
    }
}