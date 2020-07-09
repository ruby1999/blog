<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getSingle($slug){
        
        //fetch from the DB based on slug
        $post = Post::where('slug', '=', $slug)->first();
        //return th eview and pass in the post object
        return view('blog.single')->withPost($post);
        //blog資料夾下面的single.blade.php

        return view('blog.single')->withPost($post);

    }
}
