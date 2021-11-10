<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The roles that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name, is_admin'
    ];

    /**
     * Get the role that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}