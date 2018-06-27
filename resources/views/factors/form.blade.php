
<div class="form-group col-md-4 {{ $errors->has('factor') ? 'has-error' : '' }}">
    <label for="factor" class="control-label">{{ trans('factors.factor') }}</label>
    
        <input class="form-control input-sm " name="factor" type="text" id="factor" value="{{ old('factor', optional($factor)->factor) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('factors.factor__placeholder') }}">
        {!! $errors->first('factor', '<p class="help-block">:message</p>') !!}
    
</div>

