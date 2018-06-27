
<div class="form-group col-md-4 {{ $errors->has('area') ? 'has-error' : '' }}">
    <label for="area" class="control-label">{{ trans('areas.area') }}</label>
    
        <input class="form-control input-sm " name="area" type="text" id="area" value="{{ old('area', optional($area)->area) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('areas.area__placeholder') }}">
        {!! $errors->first('area', '<p class="help-block">:message</p>') !!}
    
</div>

