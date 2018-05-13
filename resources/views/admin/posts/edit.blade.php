@extends('layouts.app')

@section('content')

      @include('admin.includes.errors')

      <div class="panel panel-default">
            <div class="panel-heading">
                  Edit post: {{ $post->title }}
            </div>

            <div class="panel-body">
                  <form action="{{ route('post.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                        </div>
                        <div class="form-group">
                              <label for="image">Featured image</label>
                              <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group">
                              <label for="category">Select a Category</label>
                              <select name="category_id" id="category" class="form-control">
                                    @foreach($categories as $category)
                                          <option value="{{ $category->id }}" 
                                          @if($post->category->id == $category->id)
                                                selected
                                          @endif
                                          >{{ $category->name }}</option>
                                    @endforeach
                              </select>
                        </div>
                        <div class="form-group">
                              <label for="status">Status (Published?)</label>
                              <input name="status" type="checkbox" value="on"
                               @if ($post->status==1) 
                                    checked = "checked"
                               @endif 
                              >
                        </div>                       
                        <div class="form-group">
                              <label for="content">Content</label>
                              <textarea name="content" id="content" cols="5" rows="5" class="form-control">{{ $post->content }}</textarea>
                        </div>

                        <div class="form-group">
                              <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                          Update post
                                    </button>
                              </div>
                        </div>
                  </form>
            </div>
      </div>
@stop

@section('styles')
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">


@stop

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/jquery.tinymce.min.js"></script>
<script>
      $(document).ready(function() {
            tinymce.init({
          selector: '#content'
        });            
     //       $('#content').summernote();
      });
</script>
@stop