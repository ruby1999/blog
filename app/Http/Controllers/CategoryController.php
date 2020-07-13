<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session; //引用會話(提示新建貼文成功)

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //display a view of all of our categrocy
        //it will also have a form to create a new categrocy

        $categories = Category::all();
        return view('categories.index')->withCategories($categories);
    }

    public function store(Request $request)
    {
        //save a new category and than redirect back to index
        $this->validate($request, array(
            'name' => 'required|max:255'
            ));

        $category = new Category;

        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'New Category has been created');

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
