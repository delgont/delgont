<?php

namespace Delgont\Cms\Models\Category;


use Illuminate\Database\Eloquent\Model;
use Delgont\Cms\Models\Page\Page;
use Delgont\Cms\Models\Post\Post;
use Delgont\Cms\Models\Media\Media;
use Delgont\Cms\Models\Concerns\Iconable;




class Category extends Model
{
    use Iconable;
    
    protected $guarded = [];

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categorable');
    }

    public function pages()
    {        
        return $this->morphedByMany(Page::class, 'categorable');
    }

    public function media()
    {
        return $this->morphByMany(Media::class, 'mediable');
    }
  
}
