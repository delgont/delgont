<?php

namespace Delgont\Cms\Models\Group;


use Illuminate\Database\Eloquent\Model;
use Delgont\Cms\Models\Concerns\Iconable;
use Delgont\Cms\Models\Option\Option;




class Group extends Model
{
    use Iconable;
    
    protected $guarded = [];


    public function options()
    {
        return $this->hasMany(Option::class, 'group_id');
    }

}
