
<div class="form-group col-md-4 {{ $errors->has('planta') ? 'has-error' : '' }}">
    <label for="planta" class="control-label">{{ trans('ca_fuentes_fijas.planta') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="planta" type="text" id="planta" value="{{ old('planta', optional($caFuentesFija)->planta) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_fuentes_fijas.planta__placeholder') }}">
        {!! $errors->first('planta', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('marca') ? 'has-error' : '' }}">
    <label for="marca" class="control-label">{{ trans('ca_fuentes_fijas.marca') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="marca" type="text" id="marca" value="{{ old('marca', optional($caFuentesFija)->marca) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_fuentes_fijas.marca__placeholder') }}">
        {!! $errors->first('marca', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('ubicacion') ? 'has-error' : '' }}">
    <label for="ubicacion" class="control-label">{{ trans('ca_fuentes_fijas.ubicacion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="ubicacion" type="text" id="ubicacion" value="{{ old('ubicacion', optional($caFuentesFija)->ubicacion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_fuentes_fijas.ubicacion__placeholder') }}">
        {!! $errors->first('ubicacion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('obs') ? 'has-error' : '' }}">
    <label for="obs" class="control-label">{{ trans('ca_fuentes_fijas.obs') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="obs" type="text" id="obs" value="{{ old('obs', optional($caFuentesFija)->obs) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_fuentes_fijas.obs__placeholder') }}">
        {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('c_termica') ? 'has-error' : '' }}">
    <label for="c_termica" class="control-label">{{ trans('ca_fuentes_fijas.c_termica') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="c_termica" type="text" id="c_termica" value="{{ old('c_termica', optional($caFuentesFija)->c_termica) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_fuentes_fijas.c_termica__placeholder') }}">
        {!! $errors->first('c_termica', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tipo_combustible') ? 'has-error' : '' }}">
    <label for="tipo_combustible" class="control-label">{{ trans('ca_fuentes_fijas.tipo_combustible') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tipo_combustible" type="text" id="tipo_combustible" value="{{ old('tipo_combustible', optional($caFuentesFija)->tipo_combustible) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_fuentes_fijas.tipo_combustible__placeholder') }}">
        {!! $errors->first('tipo_combustible', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>
