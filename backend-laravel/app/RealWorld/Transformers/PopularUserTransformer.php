<?php

namespace App\RealWorld\Transformers;

class PopularUserTransformer extends Transformer
{
    protected $resourceName = 'user';

    public function transform($data)
    {
        return $data;
    }
}