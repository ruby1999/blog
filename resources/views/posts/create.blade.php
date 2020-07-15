@extends('main')

@section('title','Creat New Post')

@section('stylesheet') 
    {!! Html::style('css/select2.min.css') !!}  
    {!! Html::style('css/parsley.css') !!}      <!-- tag要引用的CSS -->
    {!! Html::style('css/select2.min.css') !!}  <!-- tag要引用的CSS -->

    <!--引用tinymce v4-->
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: 'textarea',  // change this value according to your HTML
            plugins: 'advlist link image lists code',
            menubar: false
        });
    </script>
    <!--end of 引用tinymce v4-->
@endsection


@section('content')
    <div class="col-md-8 col-md-offset-2">
        <h1>Create New Post</h1>
        <hr>
        {!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true]) !!}
        
        <!-- 'files' => true 可以傳輸資料 如果是用html參數的話要加入enctype="multipart/form-data"-->

            {{Form::label('title','Title:')}}
            {{Form::text('title', null, array('class' => 'form-control', 'required'=>'', 'maxlength'=>'255'))}}

            {{Form::label('title','Slug:')}}
            {{Form::text('slug', null, array('class' => 'form-control', 'required'=>'', 'minlength'=>'5', 'maxlength'=>'255'))}}

            {{ Form::label('category_id', 'Category:') }}
            <select class="form-control" name="category_id">
                @foreach($categories as $category)
                    <option value='{{ $category->id }}'>{{ $category->name }}</option>
                @endforeach

            </select>

            {{ Form::label('tags', 'Tags:') }}
            <select class="form-control select2-multi" name="tags[]" multiple="multiple" id="select2">
                @foreach($tags as $tag)
                    <option value='{{ $tag->id }}'>{{ $tag->name }}</option>
                @endforeach
            </select>

            {{ Form::label('featured_img', 'Upload a Featured Image') }}
            {{ Form::file('featured_img') }}
            
            {{Form::label('body','Body:')}}
            {{Form::textarea('body', null, array('class' => 'form-control'))}}

            {{Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block' , 'style' => 'margin-top:20px '))}}
            <hr>

        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')

<script src="//select2.github.io/select2/select2-3.4.2/select2.js"></script>    
{!! Html::script('js/select2.min.js') !!}  <!-- tag要引用的js -->


@endsection
