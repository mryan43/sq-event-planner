@extends('layouts.app')

@section('title', $event->name)

@section('content')

    <h1>{{$event->name}}</h1>

  TODO : Embedded video (add URL to DB) !

    <br><br>

  @if (defined('registration'))
      <a href="{{route('events.registration.show', ['event' => $event, 'registration' => $registration])}}">View registration</a>
  @else
      <a href="{{route('events.registration.create', ['event' => $event])}}">Register Now !</a>
  @endif


@endsection
