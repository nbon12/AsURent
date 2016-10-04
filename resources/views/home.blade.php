@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in! This page should show all the contracts.
                </div>
            </div>
            <form action="{{route('lalatask')}}">
                <button class="btn btn-success">Tasks</button>
            </form>
        </div>
    </div>
</div>
@endsection
