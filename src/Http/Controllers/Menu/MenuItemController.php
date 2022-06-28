<?php

namespace Stephendevs\Pagman\Http\Controllers\Menu;

use Stephendevs\Pagman\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Stephendevs\Pagman\Http\Requests\MenuItemRequest;
use Stephendevs\Pagman\Models\Menu\Menu;
use Stephendevs\Pagman\Models\Menu\MenuItem;



class MenuItemController extends Controller
{

    /**
     * Display a listing of all menu menu items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {
        $menu = Menu::getMenuItems($name)->firstOrFail();
        return view('pagman::menus.show', compact(['menu']));
    }
  

    /**
     * Show the form for creating menu item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pagman::navbar.menus.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuItemRequest $request, $id)
    {
        $request->validated();

        $menuitem = new MenuItem();
        $menuitem->name = $request->name;
        $menuitem->url = $request->url;
        $menuitem->menu_id = $id;

        $menuitem->save();

        return back()->withInput()->with('success', 'Menu Created Successfully');
    }

    /**
     * Display the specified menu and its items.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($menuitem)
    {
         return 'hello';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::findOrfail($id);
        return view('pagman::menu.edit', compact(['menu']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        


        return back()->withInput()->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MenuItem::destroy($id);
        return back()->with('success', 'Menu Item deleted from menu successfully');
    }

    private function convertPrimaryMenusToNotPrimary($request)
    {
        if($request->has('is_primary')){
            $primaries = Menu::where('is_primary', '1')->get(['id']);
            for ($i=0; $i < count($primaries) ; $i++) { 
                Menu::where('id', $primaries[$i]['id'])->update(['is_primary' => '0']);
            }
        }
    }

    private function convertFooterMenusToNotFooter($request)
    {
        if($request->has('footer')){
            $footers = Menu::where('footer', '1')->get(['id']);
            for ($i=0; $i < count($footers) ; $i++) { 
                Menu::where('id', $footers[$i]['id'])->update(['footer' => '0']);
            }
        }
    }

      /**
     * Display a listing of menus for ajax.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAjax()
    {
        $menus = Menu::all();
        return response()->json(['data' => $menus]);
    }
}
