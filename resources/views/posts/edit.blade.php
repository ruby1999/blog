@extends('main')

@section('title', 'Edit Blog Post')

@section('content')
<div class="row">
    <div class="col-md-8">
        {!! Form::model($post, ['route'=> ['posts.update', $post->id], 'method' => 'PUT']) !!}
        {{Form::label('title', 'Title:')}}
        {{Form::text('title', null, ["class"=> 'form-control'])}}
        
        {{Form::label('slug', 'Slug:', array('class' => 'form-spacing-top' ))}}
        {{Form::text('slug', null, ["class"=> 'form-control'])}}

        {{Form::label('body', 'Body:',array('class' => 'form-spacing-top' ))}}
        {{Form::textarea('body', null, ["class"=> 'form-control'])}}

    </div>

    <div class="col-md-4">
        <div class="well">
            <dl class="dl-horizontal">
                <dt>Created At:</dt>
                <dd>{{ date('Y M j h:ia', strtotime($post->created_at)) }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Last Updated:</dt>
                <dd>{{ date('Y M j h:ia', strtotime($post->updated_at)) }}</dd>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('posts.show', 'Cancel', array($post->id),  array('class' => 'btn btn-danger btn-block' )) !!}
                    {{-- button加上route導向 --}}
                </div>
                <div class="col-sm-6">
                    <!--要用form提交-->
                    {!! Form::submit('Save', array($post->id), ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            </div>
        </div>
    </div>  
    {!!Form::close() !!} 
</div>     
@endsection