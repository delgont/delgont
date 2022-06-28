<?php

namespace Stephendevs\Pagman\Models\Download;


use Illuminate\Database\Eloquent\Model;
use Stephendevs\Pagman\Models\Post\Post;



class Download extends Model
{

    public function posts()
    {
        return $this->morphByMany(Post::class, 'downloadable');
    }

}
