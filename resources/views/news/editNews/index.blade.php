@extends('layouts.navbar')

@section('headExtension')
  <title>Admin Person | Edit News</title>
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset ('plugins/summernote/summernote-bs4.min.css')}}">
@endsection

@section('container')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit News</h1>
        </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <form method="post" action="{{route('updateNews', $key)}}" enctype="multipart/form-data">
        @csrf
        <div class="card card-outline card-info"> 
            <div class="card-body">
              <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $showData['title'] }}">
              </div>
              <div class="form-group">
                <label for="exampleFormControlFile1">Thumb Nail</label>
                <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
              </div>
              <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="summernote" id="summernote">
                {{ $showData['description'] }}
                </textarea>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div class="input-group-text d-flex align-items-center">
                    <input type="checkbox" aria-label="Checkbox for following text input" id="checkbox" name="checkbox" value="Y" {{$showData['is_active'] == 'Y' ? 'checked':''}}>
                    <label for="it_active" class="form-label ml-2 mb-0">Check if news will be show in mobile app</label>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div class="input-group-text d-flex align-items-center">
                    <input type="checkbox" aria-label="Checkbox for following text input" id="checkbox" name="carousel" value="Y" {{$showData['is_carousel'] == 'Y' ? 'checked':''}}>
                    <label for="it_carousel" class="form-label ml-2 mb-0">Check if carousel will be show in mobile app</label>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
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

<!-- Page specific script -->
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote({
      placeholder: 'summernote...'
    });
  }); 

  // $('#summernote').summernote({
  //   placeholder: 'summernote...',
  //   tabsize:2;
  //   height:300
  // });
</script>
@endsection
