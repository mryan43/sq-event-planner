<div class="form-group col-sm-6" id="field-group-{{$field->id}}" data-condition="{{$field->condition}}">
    <label for="field-{{$field->id}}">{{$field->label}}</label>
    <?php
    if ($mode === 'show') {
        $readonly = "readonly";
    } else {
        $readonly = "";
    }
    if ($value == null) {
        $value1 = "";
        $value2 = "";
    } else {
        $value1 = preg_split("~\|~", $value)[0];
        $value2 = preg_split("~\|~", $value)[1];
    }

    ?>
    <input {{$readonly}} value="{{$value1}}" type="text" class="form-control" name="field-{{$field->id}}-1" id="field-{{$field->id}}-1"
           placeholder="Name and department"><br>
    <input {{$readonly}} value="{{$value2}}" type="text" class="form-control" name="field-{{$field->id}}-2" id="field-{{$field->id}}-2"
           placeholder="Name and department">
    <small class="form-text text-muted">{{$field->help}}</small>
</div>



