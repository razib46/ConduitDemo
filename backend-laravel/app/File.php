<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The files that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name, slug'
    ];

    /**
     * Get the file that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}