<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The categories that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name, slug, pinned'
    ];

    /**
     * Get the role that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function article()
    {
        return $this->hasOne(Article::class);
    }
}