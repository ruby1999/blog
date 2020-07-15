@extends('main')

@section('title', '| Edit Blog Post')

@section('stylesheet')

{!! Html::style('css/select2.min.css') !!}

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

	<div class="row">
		<div class="col-md-8">
            {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files'=> 'true']) !!}
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ["class" => 'form-control input-lg']) }}

			{{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
			{{ Form::text('slug', null, ['class' => 'form-control']) }}

			{{ Form::label('category_id', "Category:", ['class' => 'form-spacing-top']) }}
			{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

			{{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
			{{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

			{{ Form::label('featured_img', 'Update a Featured Image', ['class' => 'form-spacing-top']) }}
            {{ Form::file('featured_img') }}
			
			{{ Form::label('body', "Body:", ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control']) }}
		</div>

		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
                        <!--  button加上route導向 -->
						{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
					</div>
					<div class="col-sm-6">
                          <!-- 要用FORM提交-->
						{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>

			</div>
		</div>
		{!! Form::close() !!}
	</div>	<!-- end of .row (form) -->

@stop

@section('scripts')

	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
		$('.select2-multi').select2().val({!! json_encode($post->tags()->allRelatedIds()) !!}).trigger('change');
	</script>

@endsection


