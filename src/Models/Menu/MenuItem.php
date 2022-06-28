<?php

namespace Stephendevs\Pagman\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{

    protected $fillable = [
        'name', 'url', 'menu_id'
    ];

    


    public function menus()
    {
        return $this->belongsTo('Stephendevs\Pagman\Models\Menu\Menu', 'menu_item');
    }

    public function parent()
    {
        return $this->belongsTo('Stephendevs\Pagman\Models\Menu\MenuItem', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Stephendevs\Pagman\Models\Menu\MenuItem', 'parent_id');
    }


    //no effect
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function menuItemType()
    {
        return $this->morphTo();
    }

}
