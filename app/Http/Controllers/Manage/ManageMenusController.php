<?php

namespace App\Http\Controllers\Manage;

use Validator;
use App\Models\Menu;
use App\Rules\MenuValidator;
use Illuminate\Http\Request;
use App\Http\Controllers\Manage\ManageController;

class ManageMenusController extends ManageController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.menus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parent_id = (int) $request->input('parent_id');
        $name = (string) $request->input('name');
        Validator::make($request->all(), [
            'name' => [
                'required',
                'max:100',
                'min:2',
                'regex:/^[\pL\s\-\d]+$/u',
                new MenuValidator($name, '', $parent_id)
            ],
            'parent_id' => 'integer',
            'url' => ['nullable', 'url'],
            'target' => 'in:_self,_blank',
            'icon_class' => ['nullable', 'regex:/^[\pL\s\-\d]+$/u']
        ])->validate();

        $menu = new Menu;
        $menu->parent_id  = ($parent_id)?$parent_id:null;
        $menu->name = $name;
        $menu->url = $request->url;
        $menu->target = $request->target;
        $menu->icon_class = $request->icon_class;
        $menu->save();
        return redirect()->route('manage.menus.create')->with('success', trans('msg.created', ['attr' => 'Menu']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('manage.menus.show')->withMenu(Menu::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('manage.menus.edit')->withMenu(Menu::findOrFail($id));
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
        $menu = Menu::findOrFail($id);
        Validator::make($request->all(), [
            'name' => [
                'required',
                'max:100',
                'min:2',
                'regex:/^[\pL\s\-\d]+$/u',
                new MenuValidator($request->name, $menu->name, $request->parent_id)
            ],
            'parent_id' => 'integer',
            'url' => ['nullable', 'url'],
            'target' => 'in:_self,_blank',
            'icon_class' => ['nullable', 'regex:/^[\pL\s\-\d]+$/u']
        ])->validate();

        if($menu->id == $request->parent_id){
            return redirect()->back()->withErrors(['Self parent is not allowed.']);
        }

        $menu->parent_id  = ($request->parent_id)?(int) $request->parent_id:null;
        $menu->name = $request->name;
        $menu->url = $request->url;
        $menu->target = $request->target;
        $menu->icon_class = $request->icon_class;
        $menu->update();
        return redirect()->route('manage.menus.index')->with('success', trans('msg.updated', ['attr' => 'Menu']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($find = Menu::findOrFail($id)){
            if(count($find->children)>0)
                Menu::where('parent_id', $find->id)->update(['parent_id'=>$find->parent_id]);

            $find->delete();
            return redirect()->route('manage.menus.index')->with('success', trans('msg.deleted', ['attr' => 'Menu']));
        }
        return abort('404');
    }
}
