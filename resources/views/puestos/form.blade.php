
<div class="form-group col-md-4 {{ $errors->has('puesto') ? 'has-error' : '' }}">
    <label for="puesto" class="control-label">{{ trans('puestos.puesto') }}</label>
  
        <input class="form-control input-sm " name="puesto" type="text" id="puesto" value="{{ old('puesto', optional($puesto)->puesto) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('puestos.puesto__placeholder') }}">
        {!! $errors->first('puesto', '<p class="help-block">:message</p>') !!}
  
</div>
