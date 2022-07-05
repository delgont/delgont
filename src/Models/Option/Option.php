<?php

namespace Delgont\Cms\Models\Option;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
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
