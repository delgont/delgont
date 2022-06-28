<?php

namespace Delgont\Cms\Models\Page;


use Illuminate\Database\Eloquent\Model;

use Delgont\Cms\Models\Concerns\HasAuthor;
use Delgont\Cms\Models\Concerns\UpdatedBY;
use Delgont\Cms\Models\Concerns\Categorable;
use Delgont\Cms\Models\Concerns\Iconable;
use Delgont\Cms\Models\Concerns\Mediable;




class Page extends Model
{
    use HasAuthor, UpdatedBY, Categorable, Iconable, Mediable;

    protected $guarded = [];

    protected $with = ['author:id,name', 'updatedBy:id,name'];

}
