<div class="form-group col-sm-6" id="field-group-{{$field->id}}" data-condition="{{$field->condition}}">
    <label for="field-{{$field->id}}">{{$field->label}}</label>
    <input type="text" class="form-control" name="field-{{$field->id}}-1" id="field-{{$field->id}}-1" placeholder="Name and department"><br>
    <input type="text" class="form-control" name="field-{{$field->id}}-2" id="field-{{$field->id}}-2" placeholder="Name and department">
    <small class="form-text text-muted">{{$field->help}}</small>
</div>



