<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Http\Requests;
use App\Post;
use Session; //引用會話(提示新建貼文成功)

class PostController extends Controller
{
    public function index()
    {
        //create a variable and store all the blog posts in it from the database
        $posts = Post::all();

        //return a view and pass in the above variable
        //自動分頁的方法
        $posts = Post::orderBy('id', 'asc')->paginate(5);
        return view('posts.index')->withPosts($posts);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        //validate in the data(驗證要存入的資料，避免惡意攻擊)
        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' =>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body'  => 'required'
        ));

        //store in the database(存入資料庫)
        $post = new Post; //要引用App\Post;

        $post->title = $request ->title;
        $post->slug = $request ->slug;
        $post->body = $request->body;
        $post->save();
        Session::flash('success', '貼文新增成功！');

        //redirect to another page(導向其他頁面)
        return redirect()->route('posts.show', $post->id);

    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    public function edit($id)
    {
        //find the post in the database and save as a var
        $post = Post::find($id);
        //retueb the view and pass in the var we previously created
        return view('posts.edit')->withPost($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        //validate in the data
        if ($request->input('slug') == $post->slug){
            //如果input框中的資料和原本的資料一樣，不用驗證資料
            $this->validate($request, array(
                'title' => 'required|max:255',
                'body' => 'required'
            ));
        }else{
            $this->validate($request, array(
                'title' => 'required|max:255',
                //驗證slug在posts資料表中是獨一無二的
                'slug' =>'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'body' => 'required'
            ));

        }
        //save the data to the database
        //獲取新的數據($request ->title)存入資料庫中
        //$request ->title 要存入 $post->title 資料庫中的欄位
        //調用方法input取出叫做title的內容吋入資料庫
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = $request->input('body');
        $post->save();

        //set flash data with success message
        Session::flash('success', '貼文更新成功');
        //redirect with flash to posts.show
        return redirect()->route('posts.show', $post->id);

    }

    public function destroy($id)
    {
        //
        $post = Post::find($id);

        $post->delete();

        Session::flash('success', '貼文刪除成功');
        return redirect()->route('posts.index');
    }
}
