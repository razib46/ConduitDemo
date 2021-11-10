<?php

namespace App\RealWorld\Transformers;

class UserTransformer extends Transformer
{
    protected $resourceName = 'user';

    public function transform($data)
    {
        return [
            'email'     => $data['email'],
            'token'     => $data['token'],
            'username'  => $data['username'],
            'bio'       => $data['bio'],
            'image'     => $data['image'],
            'role_id'   => $data['role_id'],
            'role'      => $this->getRole($data['role']),
            'file_id'   => $data['file_id'],
            'file'      => $this->getFile($data['file'])
        ];
    }
}