
<div class="form-group col-md-4 {{ $errors->has('planta') ? 'has-error' : '' }}">
    <label for="planta" class="control-label">{{ trans('ca_plantas.planta') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="planta" type="text" id="planta" value="{{ old('planta', optional($caPlanta)->planta) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_plantas.planta__placeholder') }}">
        {!! $errors->first('planta', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('ubicacion') ? 'has-error' : '' }}">
    <label for="ubicacion" class="control-label">{{ trans('ca_plantas.ubicacion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="ubicacion" type="text" id="ubicacion" value="{{ old('ubicacion', optional($caPlanta)->ubicacion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_plantas.ubicacion__placeholder') }}">
        {!! $errors->first('ubicacion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('obs') ? 'has-error' : '' }}">
    <label for="obs" class="control-label">{{ trans('ca_plantas.obs') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="obs" type="text" id="obs" value="{{ old('obs', optional($caPlanta)->obs) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_plantas.obs__placeholder') }}">
        {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tipo_planta') ? 'has-error' : '' }}">
    <label for="tipo_planta" class="control-label">{{ trans('ca_plantas.tipo_planta') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tipo_planta" type="text" id="tipo_planta" value="{{ old('tipo_planta', optional($caPlanta)->tipo_planta) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_plantas.tipo_planta__placeholder') }}">
        {!! $errors->first('tipo_planta', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('c_tratamiento') ? 'has-error' : '' }}">
    <label for="c_tratamiento" class="control-label">{{ trans('ca_plantas.c_tratamiento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="c_tratamiento" type="text" id="c_tratamiento" value="{{ old('c_tratamiento', optional($caPlanta)->c_tratamiento) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_plantas.c_tratamiento__placeholder') }}">
        {!! $errors->first('c_tratamiento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>
