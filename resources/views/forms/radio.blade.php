<div class="form-group col-sm-6" id="field-group-{{$field->id}}" data-condition="{{$field->condition}}">
    <label for="field-{{$field->id}}">{{$field->label}}</label>
    <br>
    @foreach(preg_split('~;~',$field->options) as $option)
        <div class="form-check form-check-inline">
            <?php
            if ($option === $value) {
                $checked = "checked";

            } else {
                $checked = "";
            }
            if ($mode === "show") {
                $disabled = 'disabled="true"';
            } else {
                $disabled = '';
            }
            ?>

            <input {{$disabled}} {{$checked}} class="form-check-input" type="radio" name="field-{{$field->id}}"
                   id="field-{{$field->id}}-{{$option}}"
                   value="{{$option}}">


            <label class="form-check-label" for="field-{{$field->id}}-{{$option}}">{{$option}}</label>
        </div>
    @endforeach
    <small class="form-text text-muted">{{$field->help}}</small>
</div>




