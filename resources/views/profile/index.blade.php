@extends('layouts.navbar')

@section('headExtension')
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Persona | User Profile</title>
</head>
@endsection

@section('container')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Profile</h1>
      </div>
    </div>
  </div>
</section>

<!-- Main Container -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="dist/img/user4-128x128.jpg" alt="User profile picture">
            </div>
              <h2 class="profile-username text-center">{{ $user->displayName }}</h2>
              <p class="text-muted text-center">{{ $user->email }}</p>
              <div class="d-flex justify-content-center mb-3">
                <button class="btn btn-danger mr-1">
                  <a href="{{route('logOut')}}" class="text-light">Log Out</a>
                </button>
                <button class="btn btn-info">
                  <a href="/register" class="text-light">Register</a>
                </button>
            </div>
            </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <form class="tab-content" action="{{route('updateProfile')}}" method="post">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Full Name</label>
                    <input type="text" name="newDisplayName" class="form-control" value="{{ $user->displayName }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Phone Number</label>
                    <input type="text" name="newPhoneNumber" class="form-control" value="{{ $user->phoneNumber }}">
                  </div>
                </div>
              </div>
              <div>
                <button class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-light">Cancel</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <form action="{{route('updateProfilePassword')}}" class="tab-content" method="post">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">New Password</label>
                    <input name="newPassword" id="newPassword" type="password" class="form-control  @error('newPassword') is-invalid @enderror">
                    @error('newPassword')
                    <div class="invalid-feedback" style="display:block">
                    {{ $message}}
                    </div>
                  @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Confirm New Password</label>
                    <input name="confirmNewPassword" id="confirmNewPassword" type="password" class="form-control">
                  </div>
                </div>
              </div>
              <div>
                <button class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-light">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

@section('footExtension')

@endsection