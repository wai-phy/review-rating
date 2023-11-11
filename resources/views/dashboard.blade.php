@extends('layouts.master')

@section('title','Login Page')
@section('extra_css')
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh">
        <div class="col-md-6 ">
            <div class="card auth_form p-4">
                <div class="card-body">
                    @foreach ($books as $book )
                        <h1>{{$book->title}} </h1>
                        <h1>{{$book->content}} </h1>
                        <h1>{{$book->author}} </h1>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection