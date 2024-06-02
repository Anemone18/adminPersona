@extends('layouts.navbar')

@section('headExtension')
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Persona | Dashboard</title>
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
</head>
@endsection

@section('container')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-7">
        <div class="card">
          <div class="card-body">
            <h3>Welcome, {{ Session::get('displayName') }} </h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet qui eius quos, magni laborum ipsam est distinctio quam aperiam veritatis laudantium quod ratione atque commodi alias obcaecati provident iure exercitationem.</p>
          </div>
        </div>
      </div>

      <!-- <div class="col-sm-3">
        <div class="card bg-gradient-success">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="far fa-calendar-alt"></i>
              Calendar
            </h3>
          </div>
          <div class="card-body pt-0">
            <div id="calendar" style="width: 100%">
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</section>
@endsection

@section('footExtension')
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Daterange picker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script> 
<!-- Dashboard JS -->
<script src="dist/js/pages/dashboard.js"></script>
@endsection