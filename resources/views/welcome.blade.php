{{-- layout: resources/views/layouts/master.blade.php --}}
@extends('layouts.master')

@section('title')
    @parent
        Code Examples 
@endsection

@section('main')
    @parent
        <p><a href="{{url('/vids')}}">Youtube API</a></p> 
@endsection

@section('content')
    <p></p>
@endsection