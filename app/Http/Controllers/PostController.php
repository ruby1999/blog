<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;

use App\Http\Requests;
use App\Post;
use App\Category; //引用Model
use App\Tag;
use App\Comment;
use Session; //引用會話(提示新建貼文成功)

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    public function store(Request $request)
    {
        //dd($request); //檢視存入的$request
        /*
             +request: ParameterBag {#43 ▼
            #parameters: array:6 [▼
            "_token" => "U5RKGaYBBzrTfujVXrRmtpPK0vTx1aOml28bl72M"
            "title" => "Title"
            "slug" => "slugg"
            "category_id" => "1"
            "tags" => array:2 [▼
                0 => "4"
                1 => "6"
            ]
            "body" => "body"
            ]
        }
        */
        //validate in the data(驗證要存入的資料，避免惡意攻擊)
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'slug'          => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'   => 'required|integer', //保護傳入非整數的數值
            'body'          => 'required'
        ));

        //store in the database(存入資料庫)
        $post = new Post; //要引用App\Post;

        $post->title = $request ->title;
        $post->slug = $request ->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;

        $post->save();

        //同步處理
        $post->tags()->sync($request->tags, false);

        Session::flash('success', '貼文新增成功！');

        //redirect to another page(導向其他頁面)
        return redirect()->route('posts.show', $post->id);

    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    public function edit($id)
    {
        //find the post in the database and save as a var
        $post = Post::find($id);
        //-----------
        //建立一個array，用迴圈將資料表category中的name存入陣列cats中資料表category中的id
        //把陣列cats傳給posts.edit的view
        //-----------
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        //-----tags-----
        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }
        // return the view and pass in the var we previously created
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        //validate in the data
        if ($request->input('slug') == $post->slug){
            //如果input框中的資料和原本的資料一樣，不用驗證資料
            $this->validate($request, array(
                'title'         => 'required|max:255',
                'category_id'   => 'required|integer',
                'body'          => 'required'
            ));
        }else{
            $this->validate($request, array(
                'title'         => 'required|max:255',
                //驗證slug在posts資料表中是獨一無二的
                'slug'          =>'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id'   => 'required|integer',
                'body'          => 'required'
            ));

        }
        //save the data to the database
        //獲取新的數據($request ->title)存入資料庫中
        //$request ->title 要存入 $post->title 資料庫中的欄位
        //調用方法input取出叫做title的內容吋入資料庫
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = $request->input('body');

        $post->save();

        //-----tags-----
        //---同步處理
        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }


        // set flash data with success message
        Session::flash('success', 'This post was successfully saved.');

        // redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);

    }

    public function destroy($id)
    {

        $post = Post::find($id);
        $post->tags()->detach();

        $post->delete();

        Session::flash('success', 'The post was successfully deleted.');
        return redirect()->route('posts.index');
    }
}
