<div class="form-group col-sm-6 {{$class ?? ''}}" id="field-group-{{$field->id}}" data-condition="{{$field->condition}}">
    <label for="field-{{$field->id}}">{{$field->label}}</label>
    <?php
    if ($mode === "show") {
        $readonly = 'readonly';
    } else {
        $readonly = '';
    }
    ?>
    <input {{$readonly}} type="text" value="{{$value}}" name="field-{{$field->id}}" class="form-control" id="field-{{$field->id}}"
           placeholder="{{$field->placeholder}}">

    <small class="form-text text-muted">{{$field->help}}</small>
</div>




