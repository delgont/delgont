<?php

namespace Delgont\Cms\Models\Option;

use Illuminate\Database\Eloquent\Model;
use Delgont\Cms\Models\Concerns\Iconable;


class Option extends Model
{
    use Iconable;
    
    protected $table = 'options';

    protected $fillable = ['option_key', 'option_value'];

    public function scopeOption($query, $column, $value)
    {
        return $query
        ->where($column, $value);
    }

    public function scopeFIndOption($query, $column, $value)
   {
       return $query
       ->where($column, $value);
   }

}
