@extends('main')
@section('title', 'All Posts')
@section('content')
    <div class="row">    
        <div class="col-md-10">
            <h1>All Posts</h1>   
        </div>

        <div class="col-md-2"> 
            <a href="{{route('posts.create')}}" class="btn btn-primary btn-block btn-h1-spacing">Create New Post</a>
        </div> 
        <hr>
    </div> <!-- end of row -->
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Created At</th>
                </thead>

                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ substr($post->body,0 , 50)}}{{ strlen($post->body) > 100 ? "..." : ""}}</td>
                                                              <!--conditional ? if true : if flase -->
                        <td>{{ date('Y M j h:ia', strtotime($post->created_at)) }}</td>
                        <td><a herf="{{route('posts.show', $post->id)}}" class="btn btn-primary btn-block btn-sm">View</a>
                            <a herf="{{route('posts.edit', $post->id)}}" class="btn btn-primary btn-block btn-sm">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
    </div>

@endsection

