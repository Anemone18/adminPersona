@extends('layouts.navbar')

@section('headExtension')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Person | Show News</title>
@endsection

@section('container')
<!-- Main content --> 
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Show News</h1>
            </div>
        </div>
    </div>
</section>
    
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-titler text-center">{{ $showPost['title'] }}</h3>
            <div class="card-tools">
            </div>
        </div>
        <div>
            <div>
                <img src="{{$image}}" alt="">
            </div>
        </div>
        <div class="card-body">
            <div>
                {!! $showPost['description'] !!}
            </div>
        </div>
    </div>
</section>
@endsection

@section('footExtension')

@endsection

