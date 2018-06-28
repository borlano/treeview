<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get workers for the post.
     */
    public function workers()
    {
        return $this->hasMany('App\Worker');
    }
}
