<?php

namespace App\RealWorld\Transformers;

class RoleTransformer extends Transformer
{
    protected $resourceName = 'role';

    public function transform($data)
    {
        return $data;
    }
}