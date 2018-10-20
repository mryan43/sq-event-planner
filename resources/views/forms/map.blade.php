{{--<iframe width="600" height="450" frameborder="0" style="border:0"--}}
        {{--src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJGzC7eolkjEcROvHvO94JmoA&key=..."--}}
        {{--allowfullscreen>--}}
{{--</iframe>--}}
<div class="form-group">
    <label for="field-{{$field->id}}">{{$field->label}}</label><br>
    <div>
         - {{$event->location}}
    </div>

<iframe width="600" height="450" frameborder="0" style="border:0"
        src="{{$event->gmap}}&key={{\Illuminate\Support\Facades\Config::get("gmaps.apikey")}}" allowfullscreen></iframe>
</div>
