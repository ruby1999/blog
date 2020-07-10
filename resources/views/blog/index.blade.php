@extends('main')
@section('title','Blog')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Blog</h1>
            <hr>
        </div>
    </div> <!-- end of container .row-->
    <div class="row">
        <div class="col-md-8">
            @foreach($posts as $post)
            <div class="post">
                <h3>{{$post->title}}</h3>
                <h6>Published :{{date('Y M j h:ia', strtotime($post->created_at))}}</h5>
                <p> {{ substr($post->body,0 , 300)}}{{ strlen($post->body) > 100 ? "..." : ""}}</p>
                <a href="{{route('blog.single', $post->slug )}}" class="btn btn-primary">Read More</a>
                <hr>
            </div>
            @endforeach
            <div class="gl-pagination prepend-top-default">
                {!! $posts->links() !!}
            </div>
        </div>
    
    </div>       
@endsection