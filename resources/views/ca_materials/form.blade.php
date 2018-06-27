
<div class="form-group col-md-4 {{ $errors->has('material') ? 'has-error' : '' }}">
    <label for="material" class="control-label">{{ trans('ca_materials.material') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="material" type="text" id="material" value="{{ old('material', optional($caMaterial)->material) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_materials.material__placeholder') }}">
        {!! $errors->first('material', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>
