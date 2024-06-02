@extends('layouts.navbar')

@section('headExtension')
  <title>Admin Person | Approval</title>
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset ('plugins/summernote/summernote-bs4.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset ('plugins/daterangepicker/daterangepicker.css')}}">
@endsection

@section('container')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Approval</h1>
        </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <form method="post" action="createApproval" enctype="multipart/form-data">
        @csrf
        <div class="card card-outline card-info">
            <div class="card-body">
              <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
              </div>
              <div class="form-group">
                <label for="title" class="form-label">Created by</label>
                <input type="text" class="form-control" id="supervisor" name="supervisor">
              </div>
              <div class="form-group">
                <label for="inputDescription">Project Description</label>
                <textarea id="inputDescription" class="form-control" rows="4" name="description"></textarea>
              </div>
              <div class="form-group">
                <label for="exampleFormControlFile1">PDF Document</label>
                <input type="file" class="form-control-file" id="document" name="document">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
      </form>
    </div>
  </div>
</section>
@endsection

@section('footExtension')
<!-- Summernote -->
<script src="{{asset ('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset ('plugins/daterangepicker/daterangepicker.js')}}"></script>

<!-- Page specific script -->
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote({
      placeholder: 'summernote...'
    });
  }); 

  $('#reservation').daterangepicker()

  // $('#summernote').summernote({
  //   placeholder: 'summernote...',
  //   tabsize:2;
  //   height:300
  // });
</script>
@endsection
