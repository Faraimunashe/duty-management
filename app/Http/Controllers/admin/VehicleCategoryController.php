<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;

class VehicleCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.vehicle-categories', [
            'categories' => $categories
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string']
        ]);

        try{
            $category = new Category();
            $category->name = $request->name;
            $category->save();

            return redirect()->back()->with('success', 'you have successfully added a category');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error'.$e->getMessage());
        }

    }

    public function edit(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'numeric'],
            'name' => ['required', 'string']
        ]);

        try{
            $category = Category::find($request->category_id);

            $category->name = $request->name;
            $category->save();

            return redirect()->back()->with('success', 'successfully updated category');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error'.$e->getMessage());
        }

    }

    public function delete(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'numeric']
        ]);

        $cat_in_veh = Vehicle::where('category_id', $request->category_id)->first();
        if(!is_null($cat_in_veh)){
            return redirect()->back()->with('error', 'You cannot delete this category at the moment');
        }

        try{
            Category::find($request->category_id)->delete();
            return redirect()->back()->with('success', 'you have successfully deleted category');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error'.$e->getMessage());
        }

    }
}
