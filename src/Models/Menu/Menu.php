<?php

namespace Stephendevs\Pagman\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $cast = [
        'menu_cache' => 'array'
    ];


    public function scopeFindMenu($query, $column, $value)
    {
        return $query
        ->where($column, $value);
    }


    public function scopeFindMenuItems($query, $menu_name)
    {
        return $query->with(['menuItems' => function($q){
            $q->with(['children'])->whereNull('parent_id')->orderBy('item_order', 'asc');
        }])
        ->where('name', $menu_name);
    }

    public function scopeTestFindMenuItems($query, $menu_name)
    {
        return $query->with(['menuItems' => function($q){
            $q->with(['children' => function($qr){
                $qr->with(['children']);
            }])->whereNull('parent_id')->orderBy('item_order', 'asc');
        }])
        ->where('name', $menu_name);
    }




    public function scopeGetMenuByName($query, $name)
    {
        return $query
        ->where('name', $name);
    }
    
    public function scopeGetMdenuItems($query, $menu_name)
    {
        return $query->with(['items' => function($q){
            $q->orderBy('menu_item.item_order', 'asc')->get();
        }])
        ->where('name', $menu_name);
    }

    public function scopeGetMenuItems($query, $menu_name)
    {
        return $query->with(['menuItems' => function($q){
            $q->with(['children'])->whereNull('parent_id')->orderBy('item_order', 'asc');
        }])
        ->where('name', $menu_name);
    }


    public function getMenuCacheAttribute($value)
    {
        return json_decode($value);
    }


    public function menuItems()
    {
        return $this->hasMany('Stephendevs\Pagman\Models\Menu\MenuItem');
    }


}
