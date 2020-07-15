@extends('main')

@section('title', 'View Post')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>{{ $post->title}}</h1>
        <p class="lead">{!!$post->body !!}</p>

        <div class="tags">
            @foreach ($post->tags as $tag)
                <span class="badge badge-info">{{ $tag->name }}</span>
            @endforeach
        </div>

        <!-- comments.edit -->
        <div id="backend-comments" style="margin-top: 50px;">
            <h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>
            @if(!empty($post->image))
				<img src="{{asset('images/' . $post->image)}}" width="650" height="200" />
			@endif

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th width="70px"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($post->comments as $comment)
                    <tr>
                        <td>{{ $comment->name }}</td>
                        <td>{{ $comment->email }}</td>
                        <td>{{ $comment->comment }}</td>
                        <td>
                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- end of comments.edit -->
    </div>


    <div class="col-md-4">
        <div class="well">
            <dl class="dl-horizontal">
                <dt>Url Slug:</dt>
                <dd><a href="{{url('blog/'.$post->slug)}}"> {{url('blog/'.$post->slug)}}</a></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Category:</dt>
                <p>{{ $post->category->name }}</p>
            </dl>
            <dl class="dl-horizontal">
                <dt>Create At:</dt>
                <dd>{{ date('Y M j h:ia', strtotime($post->created_at)) }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Last Update:</dt>
                <dd>{{ date('Y M j h:ia', strtotime($post->updated_at)) }}</dd>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('posts.edit', 'Edit', array($post->id),  array('class' => 'btn btn-primary btn-block' )) !!}
                    {{-- button加上route導向 --}}
                </div>
                <div class="col-sm-6">
                    {!! Form::open(['route' => ['posts.destroy', $post->id], 'method'=>'DELETE']) !!}
                    {!! Form::submit('Delect',  ['class' => 'btn btn-danger btn-block']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {!! Html::linkRoute('posts.index', 'Back to all posts', array(),  array('class' => 'btn btn-secondary btn-block btn-h1-spacing btn-outline-light' )) !!}
                </div>
            </div>
        </div>
    </div>   
</div>     
@endsection

