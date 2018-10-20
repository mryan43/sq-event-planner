@extends('layouts.app')

@section('title', $event->name." - Registration")

@section('content')

    <h1>{{$event->name}} - Registration</h1>
    <br>
    <div class="card-group col-sm-6 ">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <p class="card-text">
                    <svg style="margin-top:-4px" width="18" height="18" viewBox="0 0 14 16" version="1.1" aria-hidden="true"><path fill-rule="evenodd" d="M13 2h-1v1.5c0 .28-.22.5-.5.5h-2c-.28 0-.5-.22-.5-.5V2H6v1.5c0 .28-.22.5-.5.5h-2c-.28 0-.5-.22-.5-.5V2H2c-.55 0-1 .45-1 1v11c0 .55.45 1 1 1h11c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1zm0 12H2V5h11v9zM5 3H4V1h1v2zm6 0h-1V1h1v2zM6 7H5V6h1v1zm2 0H7V6h1v1zm2 0H9V6h1v1zm2 0h-1V6h1v1zM4 9H3V8h1v1zm2 0H5V8h1v1zm2 0H7V8h1v1zm2 0H9V8h1v1zm2 0h-1V8h1v1zm-8 2H3v-1h1v1zm2 0H5v-1h1v1zm2 0H7v-1h1v1zm2 0H9v-1h1v1zm2 0h-1v-1h1v1zm-8 2H3v-1h1v1zm2 0H5v-1h1v1zm2 0H7v-1h1v1zm2 0H9v-1h1v1z"></path></svg>
                    {{$event->time->format('l d-m-Y')}}</p>
                <p class="card-text">
                    <svg style="margin-top:-2px" width="18" height="18" class="octicon octicon-clock" viewBox="0 0 14 16" version="1.1" aria-hidden="true"><path fill-rule="evenodd" d="M8 8h3v2H7c-.55 0-1-.45-1-1V4h2v4zM7 2.3c3.14 0 5.7 2.56 5.7 5.7s-2.56 5.7-5.7 5.7A5.71 5.71 0 0 1 1.3 8c0-3.14 2.56-5.7 5.7-5.7zM7 1C3.14 1 0 4.14 0 8s3.14 7 7 7 7-3.14 7-7-3.14-7-7-7z"></path></svg>
                    {{$event->time->format('H:i T')}}</p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <p class="card-text">
                    <svg style="margin-top:-2px" width="18" height="18" class="octicon octicon-location" viewBox="0 0 12 16" version="1.1" aria-hidden="true"><path fill-rule="evenodd" d="M6 0C2.69 0 0 2.5 0 5.5 0 10.02 6 16 6 16s6-5.98 6-10.5C12 2.5 9.31 0 6 0zm0 14.55C4.14 12.52 1 8.44 1 5.5 1 3.02 3.25 1 6 1c1.34 0 2.61.48 3.56 1.36.92.86 1.44 1.97 1.44 3.14 0 2.94-3.14 7.02-5 9.05zM8 5.5c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"></path></svg>
                    Geneva - Palexpo</p>
                <a href="{{$event->gmap}}" class="card-link">Open in Google Maps</a>
            </div>
        </div>
    </div>
    <div>
        <br>
        <form action="{{route('events.registration.store', ['event' => $event])}}" method="post">
            {{ csrf_field() }}
            <?php
            $field = new stdClass();
            $field->id = 1;
            $field->label = "Will you be present at this event ?";
            $field->type = "radio";
            $field->options = "Yes;No";
            $field->help = "";
            $field->condition = "";
            ?>

            @include('forms.radio', ['field' => $field])

            <div id="participant-form" style="display:none">
                @foreach($event->fields as $field)
                    @include('forms.'.$field->type, ['field' => $field, 'mode' => $mode])
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


@endsection
