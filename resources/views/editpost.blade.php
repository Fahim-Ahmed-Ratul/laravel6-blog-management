@extends('welcome')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">

      <a href="{{ route('all.post')}}" class="btn btn-info">All Posts</a>

      <form action="{{ url('update/post/'.$post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Post Title</label>
            <input type="text" class="form-control" name="title" value="{{ $post->title}}" >
          </div>
        </div>
        <br/>

        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Category</label>
            <select class="form-control" name="category_id">
              @foreach($category as $row)
              <option value="{{ $row->id }}" <?php if($row->id == $post->category_id) echo "selected"; ?> >{{ $row->name }}</option>s
              @endforeach
            </select>
          </div>
        </div>
        <br/>

        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>New Image</label>
            <input type="file" class="form-control" name="image"><br>
            Old Image:<img src="{{ URL::to($post->image) }}" style="height: 40px; width: 80px;" alt="">
            <input type="hidden" name="old_photo" value="{{ $post->image}}">
          </div>
        </div>
        <br/>

        <div class="control-group">
          <div class="form-group col-xs-12 floating-label-form-group controls">
            <label>Post Details</label>
            <textarea rows="5" class="form-control"  name="details" required>
                {{ $post->details }}
            </textarea>
          </div>
        </div>

        <br>

        <div id="success"></div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" id="sendMessageButton">Update</button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection
