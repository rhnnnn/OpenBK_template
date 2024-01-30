@extends('layouts.app',['title'=>'Home'])
@section('content')
@auth
    
<h1>{{Auth::user()->username}}</h1>
<h4>{{Auth::user()->getRoleNames()->implode(', ')}}</h4>
<br>
@endauth

@endsection