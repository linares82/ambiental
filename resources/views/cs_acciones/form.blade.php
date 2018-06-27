
<div class="form-group col-md-4 {{ $errors->has('accion') ? 'has-error' : '' }}">
    <label for="accion" class="control-label">{{ trans('cs_acciones.accion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="accion" type="text" id="accion" value="{{ old('accion', optional($csAccione)->accion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('cs_acciones.accion__placeholder') }}">
        {!! $errors->first('accion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

