@extends('welcome')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <a href="{{ route('student') }}" class="btn btn-danger">Add Student</a>

      <hr>
    <table class="table table-responsive table-hover">
      <tr>
        <th>SL</th>
        <th>Student Name</th>
        <th>Student Phone</th>
        <th>Student Email</th>
        <th>Action</th>
      </tr>
      @foreach($student as $row)
      <tr>
        <td>{{ $row->id }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->phone }}</td>
        <td>{{ $row->email }}</td>
        <td>
          <a href="{{ URL::to('edit/student/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
          <a href="{{ URL::to('delete/student/'.$row->id) }}" class="btn btn-sm btn-danger">Delete</a>
          <a href="{{ URL::to('view/student/'.$row->id) }}" class="btn btn-sm btn-success">View</a>
        </td>
      </tr>
      @endforeach
    </table>
    </div>
  </div>
</div>
@endsection
