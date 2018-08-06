<?php
namespace App\Http\Controllers\Manage;

use Validator;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Rules\CategoryValidator;
//use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Manage\ManageController;

class ManageCategoriesController extends ManageController
{

    public function index(Category $category)
    {
        return view('manage.categories.index');
    }

    public function create()
    {
        return view('manage.categories.create');
    }

    public function store(Request $request)
    {
        $parent_id = (int) $request->input('parent_id');
        $name = (string) $request->input('name');
        Validator::make($request->all(), [
            'name' => [
                'required',
                'max:100',
                'min:2',
                'regex:/^[\pL\s\-\d]+$/',
                new CategoryValidator($name, '', $parent_id)
            ],
            'parent_id' => 'integer'
        ])->validate();

        $cats = new Category;
        $cats->name = $name;
        $cats->parent_id  = ($parent_id)?$parent_id:null;
        $cats->save();
        return redirect()->route('manage.categories.create')->with('success', trans('msg.created', ['attr' => 'Category']));
    }

  
    public function show($id)
    {
        return view('manage.categories.show')->withCategory(
            Category::findOrFail($id)
        );
    }   

    public function edit($id)
    {
        return view('manage.categories.edit')->withCategory(
            Category::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $cat = Category::findOrFail($id);
        Validator::make($request->all(), [
            'name' => [
                'required',
                'max:100',
                'min:2',
                'regex:/^[\pL\s\-\d]+$/',
                new CategoryValidator($request->input('name'), $cat->name, $request->input('parent_id'))
            ],
            'parent_id' => 'integer'
        ])->validate();
    
        if($cat->id == $request->input('parent_id')){
            return redirect()->back()->withErrors(['Self parent is not allowed.']);
        }

        $cat->name = $request->input('name');
        $cat->parent_id  = ($request->input('parent_id'))?$request->input('parent_id'):null;
        $cat->update();
        return redirect()->route('manage.categories.index')->with('success', trans('msg.updated', ['attr' => 'Category']));
    }

    // public function delete($id, Request $request){
    //     $find = Category::findOrFail($id);
    //     if($find){
    //         if(count($find->children)>0){
    //             if(Category::where('parent_id', $find->id)->update(['parent_id'=>$find->parent_id])){
    //                 $find->delete();
    //                 return redirect('manage/categories')->with('success', 'Category deleted');
    //             }
    //         } else {
    //             $find->delete();
    //             return redirect('manage/categories')->with('success', 'Category deleted');
    //         }
    //     }
    //      return redirect('manage/categories')->with('error', 'not found');
    // }


    public function destroy($id, Request $request)
    {
        if($find = Category::findOrFail($id)){
            if(count($find->children)>0)
                Category::where('parent_id', $find->id)->update(['parent_id'=>$find->parent_id]);
                
            $find->delete();
            return redirect('manage/categories')->with('success', trans('msg.deleted', ['attr' => 'Category']));
        }
        return abort('404');
    }
}
