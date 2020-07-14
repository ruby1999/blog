<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Session;

class CommentsController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $post_id)
    {
        $this->validate($request, array(
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255',
            'comment'   => 'required|min:5|max:2000'
        ));

        //store in the database(存入資料庫)
        $post = Post::find($post_id);

        $comment = new Comment; //要引用App\Post;
        
        $comment->name = $request ->name;
        $comment->email = $request ->email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($post);

        $comment->save();

        Session::flash('success', '留言新增成功！');
        //return redirect()->route('blog.single',[$post->id]);        
        return view('blog.single')->withPost($post);

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
