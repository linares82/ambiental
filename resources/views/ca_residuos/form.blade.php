
<div class="form-group col-md-4 {{ $errors->has('residuo') ? 'has-error' : '' }}">
    <label for="residuo" class="control-label">{{ trans('ca_residuos.residuo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="residuo" type="text" id="residuo" value="{{ old('residuo', optional($caResiduo)->residuo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_residuos.residuo__placeholder') }}">
        {!! $errors->first('residuo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('unidad') ? 'has-error' : '' }}">
    <label for="unidad" class="control-label">{{ trans('ca_residuos.unidad') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="unidad" type="text" id="unidad" value="{{ old('unidad', optional($caResiduo)->unidad) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_residuos.unidad__placeholder') }}">
        {!! $errors->first('unidad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('peligroso') ? 'has-error' : '' }}">
    <label for="peligroso" class="control-label">{{ trans('ca_residuos.peligroso') }}</label>
    
        <div class="checkbox">
            <label for="peligroso_1">
            	<input id="multi_entidad_1" class="" name="peligroso" type="checkbox" value="1" {{ old('peligroso', optional($caResiduo)->peligroso) == '1' ? 'checked' : '' }}>
                Si
            </label>
        </div>

        {!! $errors->first('peligroso', '<p class="help-block">:message</p>') !!}
    
</div>
