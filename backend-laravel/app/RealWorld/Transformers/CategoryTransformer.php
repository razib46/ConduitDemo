<?php

namespace App\RealWorld\Transformers;

class CategoryTransformer extends Transformer
{
    protected $resourceName = 'category';

    public function transform($data)
    {
        return $data;
    }
}