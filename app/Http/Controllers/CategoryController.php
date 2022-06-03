<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Session;
use Validator;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index(){
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function create(){
        return view('category.create');
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:500',
        ]);
        // Create The Category
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        
        Session::flash('category_create','New Category is Created');
        return redirect('category');
    }

    public function destroy($id) {
    	$categories = Category::find($id);
    	$categories->delete();
    	Session::flash('category_delete','Category is Delete');
    	return redirect('category');
    }

    public function edit($id)
    {
        $categories = Category::find($id);
        return view('category.edit')->with('categories', $categories);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:500',
        ]);

        $validator = Validator::make($request->all(), [
			'name' => 'required|max:20|min:3',
			'description' => 'required|max:20|min:3',
		]);
		if ($validator->fails()) {
			return redirect('category/' .$id . '/edit')
            ->withInput()
            ->withErrors($validator);
		}

		// Create The Category

		$category = Category::find($id);
		$category->name = $request->Input('name');
        $category->description = $request->Input('description');
		$category->save();

		Session::flash('category_update','Category is Update');

		return redirect('category');
    }

}
