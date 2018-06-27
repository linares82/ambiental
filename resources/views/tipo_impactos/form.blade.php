
<div class="form-group col-md-4 {{ $errors->has('tipo_impacto') ? 'has-error' : '' }}">
    <label for="tipo_impacto" class="control-label">{{ trans('tipo_impactos.tipo_impacto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tipo_impacto" type="text" id="tipo_impacto" value="{{ old('tipo_impacto', optional($tipoImpacto)->tipo_impacto) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('tipo_impactos.tipo_impacto__placeholder') }}">
        {!! $errors->first('tipo_impacto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

