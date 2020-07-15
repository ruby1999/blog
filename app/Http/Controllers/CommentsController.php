<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Session;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }

    public function store(Request $request, $post_id)
    {
        
        //dd($request, $post_id);
        $this->validate($request, array(
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255',
            'comment'   => 'required|min:5|max:2000'
        ));
        //dd($this);
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
        //return redirect()->route('blog.single')->withPost($post);
        return redirect()->route('blog.single', [$post->slug]); //用array傳

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //find the commenets in the database and save as a var
        $comments = Comment::find($id);
        // return the view and pass in the var we previously created
        return view('comments.edit')->withComment($comments);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        $this->validate($request, array(
            'comment'   => 'required|min:5|max:2000'
        ));

        //$comment->name = $request->input('name');
        //$comment->email = $request->input('email');
        $comment->comment = $request->input('comment');

        $comment->save();

        // set flash data with success message
        Session::flash('success', '留言修改成功');

        // redirect with flash data to posts.show
        return redirect()->route('posts.show', $comment->post->id);
        //table comment 裡面的post 的id (可以這樣傳的喔(奇耙))
    }

    public function delete($id)
    {
        //find the commenets in the database and save as a var
        $comments = Comment::find($id);
        // return the view and pass in the var we previously created
        return view('comments.delete')->withComment($comments);
    }
    
    public function destroy($id)
    {
        $comment = Comment::find($id);

        $comment->delete();

        /*或是也可以先把變數存起來，如果後面不會衝突的話
        $post_id = $comment->post->id;
        return redirect()->route('posts.show', $post_id);
        */ 


        Session::flash('success', '留言刪除成功');
        return redirect()->route('posts.show', $comment->post->id);
    }
}
