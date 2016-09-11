@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        @include('posts.create',['user'=>$user])
                        @include('posts.index',['posts'=>$posts])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
