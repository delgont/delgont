<?php

namespace Delgont\Cms\Models\Post;


use Illuminate\Database\Eloquent\Model;
use Delgont\Cms\Traits\MenuItemTypeModel as MenuItems;
use Delgont\Cms\Traits\PostRelation;
use Delgont\Cms\Concerns\Mediable;
use Delgont\Cms\Concerns\Categorable;
use Delgont\Cms\Concerns\Iconable;
use Delgont\Cms\Concerns\Sociable;
use Delgont\Cms\Concerns\Downloadable;
use Delgont\Cms\Concerns\Contactable;



class Post extends Model
{
    use MenuItems, PostRelation, Mediable, Categorable, Iconable, Sociable, Contactable;


    protected $fillable = [
        'post_key', 'post_type', 'post_title', 'post_content', 'post_featured_image', 'extract_text'
    ];
    
    protected $with = ['author:id,name'];
    
    public function scopedFindPost($query, $column, $value)
    {
        return $query
        ->where($column, $value);
    }

    //Retrieve posts of a specific type
    public function scopePosts($query, $type = null, $paginated = false, $count = 4)
    {
        if($paginated){
            if($type != null){
                return $query
                ->where('post_type', $type)
                ->paginate($count);
            }else{
                return $query
                ->paginate($count);
            }
        }else{
            if($type != null){
                return $query
                ->where('post_type', $type)
                ->get();
            }else{
                return $query
                ->get();
            }
        }
        
    }

    //The latest news
    public function scopeLatestNews($query, $paginate = false, $count = 4)
    {
        if($paginate){
            return $query
            ->where('post_type', 'news')
            ->with(['author:id,username'])
            ->paginate($count);
        }
        return $query
        ->where('post_type', 'news')
        ->with(['author:id,username'])
        ->get();
    }

    public function scopeFindNews($query, $id)
    {
        return $query
        ->where('id', $id);
    }

    public function scopeFindPage($query, $column, $value)
    {
        return $query
        ->where($column, $value)
        ->where('post_type', 'page');
    }

    public function scopePages($query)
    {
        return $query
        ->where('post_type', 'page');
    }



  
}
