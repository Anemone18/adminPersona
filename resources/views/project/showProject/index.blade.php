@extends('layouts.navbar')

@section('headExtension')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Person | Detail of Project</title>
@endsection

@section('container')
<!-- Main content --> 
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Show Detail of Project</h1>
            </div>
        </div>
    </div>
</section>
    
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-titler text-center">{{ $showProject['title'] }}</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            <div>
                <p>{{ $showProject['description'] }}</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footExtension')

@endsection

