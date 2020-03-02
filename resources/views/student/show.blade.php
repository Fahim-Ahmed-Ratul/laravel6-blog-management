@extends('welcome')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <a href="{{ route('all.student') }}" class="btn btn-info">All Student</a>
      <hr>
      <div>
        <ol>
          <li>Id: {{ $student->id }}</li>
          <li>Category Name: {{ $student->name }}</li>
          <li>Category Slug: {{ $student->phone }}</li>
          <li>Created At: {{ $student->email }}</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@endsection
