
<div class="form-group col-md-4 {{ $errors->has('rubro') ? 'has-error' : '' }}">
    <label for="rubro" class="control-label">{{ trans('rubros.rubro') }}</label>
    
        <input class="form-control input-sm " name="rubro" type="text" id="rubro" value="{{ old('rubro', optional($rubro)->rubro) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('rubros.rubro__placeholder') }}">
        {!! $errors->first('rubro', '<p class="help-block">:message</p>') !!}
    
</div>

