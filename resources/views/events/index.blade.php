@extends('layouts.app')

@section('title', 'All')

@section('content')

    @foreach ($events as $event)
       <a href="{{route('events.show', ['event' => $event])}}">{{$event->name}}</a>
    @endforeach
@endsection
