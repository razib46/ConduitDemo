<?php

namespace App\RealWorld\Transformers;

class FileTransformer extends Transformer
{
    protected $resourceName = 'file';

    public function transform($data)
    {
        return $data;
    }
}