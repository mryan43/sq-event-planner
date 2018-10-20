<div class="form-group col-sm-6" id="field-group-{{$field->id}}" data-condition="{{$field->condition}}">
    <label for="field-{{$field->id}}">{{$field->label}}</label>
    <br>
    @if ($mode === "show")
        PROUT
    @else
        @foreach(preg_split('~;~',$field->options) as $option)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="field-{{$field->id}}" id="field-{{$field->id}}-{{$option}}" value="{{$option}}">
                <label class="form-check-label" for="field-{{$field->id}}-{{$option}}">{{$option}}</label>
            </div>
        @endforeach
    @endif
    <small class="form-text text-muted">{{$field->help}}</small>
</div>




